<?php

namespace App\Services;

use App\Contracts\ConverterInterface;
use App\Contracts\FileValidatorInterface;
use App\Contracts\TemporaryFileManagerInterface;
use App\DTOs\ConversionRequest;
use App\Enums\ConversionStatus;
use App\Events\ConversionCompleted;
use App\Events\ConversionFailed;
use App\Events\ConversionStarted;
use App\Exceptions\DailyConversionLimitExceeded;
use App\Exceptions\FileTooLargeException;
use App\Exceptions\SameFormatException;
use App\Exceptions\UnsupportedFormatException;
use App\Jobs\ConvertFileJob;
use App\Models\Conversion;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ConversionService
{
    public function __construct(
        private ConverterRegistry $registry,
        private FileValidatorInterface $validator,
        private TemporaryFileManagerInterface $tempManager,
    ) {}

    public function convert(UploadedFile $file, string $targetFormat, array $options = []): Conversion
    {
        $conversionId = null;

        $this->checkDailyConversionLimit();

        try {
            $dto = ConversionRequest::fromUpload($file, $targetFormat, $options);

            $this->validator->validate($dto);

            $data = [
                'uuid' => (string) Str::uuid(),
                'source_filename' => $file->getClientOriginalName(),
                'source_mime_type' => mime_content_type($file->getRealPath()),
                'source_extension' => $dto->sourceExtension,
                'source_size' => $file->getSize(),
                'target_extension' => $dto->targetFormat,
                'category' => $dto->category->value,
                'status' => ConversionStatus::Pending,
                'options' => $options,
                'ip_address' => request()->ip(),
            ];
            // store user_id only if column exists (migrasi belum jalan, hindari error)
            if (\Illuminate\Support\Facades\Schema::hasColumn('conversions', 'user_id') && Auth::check()) {
                $data['user_id'] = Auth::id();
            }
            $conversion = Conversion::create($data);

            $conversionId = $conversion->id;

            $tempSource = $this->tempManager->store($file, $conversion->id);

            ConvertFileJob::dispatch($conversion->id, $tempSource);

            ConversionStarted::dispatch($conversion);

            return $conversion;

        } catch (FileTooLargeException | SameFormatException | UnsupportedFormatException $e) {
            if ($conversionId) {
                Conversion::where('id', $conversionId)->update([
                    'status' => ConversionStatus::Failed,
                    'error_message' => $e->getMessage(),
                ]);
            }
            throw $e;
        }
    }

    public function getStatus(string $uuid): ?Conversion
    {
        return Conversion::where('uuid', $uuid)->first();
    }

    public function getSupportedFormats(): array
    {
        return config('converter.formats', []);
    }

    private function checkDailyConversionLimit(): void
    {
        // Subscription = unlimited
        if (Auth::check() && auth()->user()->hasUnlimitedAccess()) {
            return;
        }

        // Tiered limit: Free 7, Single 20
        $limit = (int) config('converter.limits.per_user_daily', 7);
        if (Auth::check() && auth()->user()->hasActiveSingle()) {
            $limit = (int) config('converter.limits.single_daily', 20);
        }

        $today = now()->startOfDay();
        $since = $today;

        if (Auth::check() && \Illuminate\Support\Facades\Schema::hasColumn('conversions', 'user_id')) {
            $count = Conversion::where('user_id', Auth::id())
                ->where('created_at', '>=', $since)
                ->count();
        } else {
            $ip = request()->ip();
            $count = Conversion::where('ip_address', $ip)
                ->where('created_at', '>=', $since)
                ->count();
        }

        if ($count >= $limit) {
            $msg = 'Batas harian ' . $limit . ' konversi tercapai. ';
            if ($limit === 7) {
                $msg .= 'Beli Single (20/hari) atau Subscription (unlimited) untuk lanjut.';
            } else {
                $msg .= 'Single = 20/hari (bukan unlimited). Beli Subscription untuk unlimited.';
            }
            throw new DailyConversionLimitExceeded($msg);
        }
    }
}
