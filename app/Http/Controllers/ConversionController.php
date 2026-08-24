<?php

namespace App\Http\Controllers;

use App\Services\ConversionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversionController extends Controller
{
    public function __construct(
        private ConversionService $conversionService,
    ) {}

    public function index()
    {
        $formats = $this->conversionService->getSupportedFormats();

        $recentConversions = \App\Models\Conversion::where('ip_address', request()->ip())
            ->latest()
            ->take(10)
            ->get();

        $hasUnlimited = false;
        $activeSingleCount = 0;
        $today = now()->startOfDay();
        $since = $today;
        $dailyLimit = (int) config('converter.limits.per_user_daily', 7);

        if (Auth::check()) {
            $user = auth()->user();
            $hasUnlimited = $user->hasUnlimitedAccess();
            $activeSingleCount = $user->activeSingleLicensesCount();
            // Tiered limit: Single = 20, Free = 7
            if (!$hasUnlimited) {
                $dailyLimit = $user->hasActiveSingle()
                    ? (int) config('converter.limits.single_daily', 20)
                    : (int) config('converter.limits.per_user_daily', 7);
            }
            if (\Illuminate\Support\Facades\Schema::hasColumn('conversions', 'user_id')) {
                $conversionsToday = \App\Models\Conversion::where('user_id', $user->id)
                    ->where('created_at', '>=', $since)
                    ->count();
            } else {
                $conversionsToday = \App\Models\Conversion::where('ip_address', request()->ip())
                    ->where('created_at', '>=', $since)
                    ->count();
            }
        } else {
            $conversionsToday = \App\Models\Conversion::where('ip_address', request()->ip())
                ->where('created_at', '>=', $since)
                ->count();
        }

        // Subscription = unlimited, jadi tidak ada batas
        if ($hasUnlimited) {
            $remaining = 999;
            $usagePercent = 0;
            $isLimitReached = false;
        } else {
            $remaining = max(0, $dailyLimit - $conversionsToday);
            $usagePercent = $dailyLimit > 0 ? (int) min(100, round($conversionsToday / $dailyLimit * 100)) : 0;
            $isLimitReached = $conversionsToday >= $dailyLimit;
        }

        return view('converter.index', [
            'formats' => $formats,
            'recentConversions' => $recentConversions,
            'conversionsToday' => $conversionsToday,
            'dailyLimit' => $dailyLimit,
            'remaining' => $remaining,
            'usagePercent' => $usagePercent,
            'isLimitReached' => $isLimitReached,
            'hasUnlimited' => $hasUnlimited,
            'activeSingleCount' => $activeSingleCount,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:204800',
            'target_format' => 'required|string|max:10',
        ]);

        try {
            $conversion = $this->conversionService->convert(
                $request->file('file'),
                $request->input('target_format'),
                $request->only(['quality', 'bitrate', 'codec', 'crf', 'preset']),
            );

            return redirect()
                ->route('convert.show', $conversion->uuid)
                ->with('success', 'Conversion started! Your file is being processed.');

        } catch (\App\Exceptions\FileTooLargeException $e) {
            return back()->withErrors(['file' => $e->getMessage()])->withInput();
        } catch (\App\Exceptions\SameFormatException $e) {
            return back()->withErrors(['target_format' => $e->getMessage()])->withInput();
        } catch (\App\Exceptions\UnsupportedFormatException $e) {
            return back()->withErrors(['target_format' => $e->getMessage()])->withInput();
        } catch (\App\Exceptions\DailyConversionLimitExceeded $e) {
            return back()->withErrors(['file' => $e->getMessage()])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'Conversion failed: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(string $uuid)
    {
        $conversion = \App\Models\Conversion::where('uuid', $uuid)->firstOrFail();

        return view('converter.show', ['conversion' => $conversion]);
    }

    public function download(string $uuid)
    {
        $conversion = \App\Models\Conversion::where('uuid', $uuid)->firstOrFail();

        if (!$conversion->isCompleted()) {
            return back()->withErrors(['error' => 'Conversion is not completed yet.']);
        }

        $fullPath = storage_path('app/' . $conversion->output_path);

        if (!file_exists($fullPath)) {
            return back()->withErrors(['error' => 'Output file not found.']);
        }

        return response()->download(
            $fullPath,
            $conversion->source_filename . '.converted.' . $conversion->target_extension
        );
    }

    public function destroy(string $uuid)
    {
        $conversion = \App\Models\Conversion::where('uuid', $uuid)->firstOrFail();

        if ($conversion->output_path) {
            $fullPath = storage_path('app/' . $conversion->output_path);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        $conversion->delete();

        return redirect()->route('convert.index')
            ->with('success', 'Conversion deleted.');
    }
}
