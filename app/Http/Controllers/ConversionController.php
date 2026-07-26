<?php

namespace App\Http\Controllers;

use App\Services\ConversionService;
use Illuminate\Http\Request;

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

        return view('converter.index', [
            'formats' => $formats,
            'recentConversions' => $recentConversions,
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
