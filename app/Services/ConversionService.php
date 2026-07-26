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
use App\Exceptions\FileTooLargeException;
use App\Exceptions\SameFormatException;
use App\Exceptions\UnsupportedFormatException;
use App\Jobs\ConvertFileJob;
use App\Models\Conversion;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

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

        try {
            $dto = ConversionRequest::fromUpload($file, $targetFormat, $options);

            $this->validator->validate($dto);

            $conversion = Conversion::create([
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
            ]);

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
}
