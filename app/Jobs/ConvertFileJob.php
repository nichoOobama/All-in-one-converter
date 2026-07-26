<?php

namespace App\Jobs;

use App\Contracts\ConverterInterface;
use App\Enums\ConversionStatus;
use App\Events\ConversionCompleted;
use App\Events\ConversionFailed;
use App\Models\Conversion;
use App\Services\ConverterRegistry;
use App\Services\TemporaryFileManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ConvertFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $timeout = 3600;

    public function __construct(
        public int $conversionId,
        public string $sourcePath,
    ) {}

    public function handle(
        ConverterRegistry $registry,
        TemporaryFileManager $tempManager,
    ): void {
        $conversion = Conversion::findOrFail($this->conversionId);

        $conversion->update(['status' => ConversionStatus::Processing]);

        Log::info("Starting conversion #{$conversion->id}", [
            'source' => $conversion->source_filename,
            'target' => $conversion->target_extension,
            'category' => $conversion->category,
        ]);

        try {
            $category = \App\Enums\FileCategory::from($conversion->category);
            $converter = $registry->resolve($category);

            $outputDir = $tempManager->getOutputDir($conversion->id);
            $fullOutputDir = storage_path('app/' . $outputDir);

            if (!is_dir($fullOutputDir)) {
                mkdir($fullOutputDir, 0755, true);
            }

            $dto = new \App\DTOs\ConversionRequest(
                file: new \Illuminate\Http\UploadedFile(
                    $this->sourcePath,
                    $conversion->source_filename,
                    $conversion->source_mime_type,
                    null,
                    true
                ),
                sourceExtension: $conversion->source_extension,
                targetFormat: $conversion->target_extension,
                category: $category,
                options: $conversion->options ?? [],
            );

            $result = $converter->convert($dto, $this->sourcePath, $fullOutputDir);

            $outputRelativePath = $outputDir . '/' . $result->outputFilename;

            $conversion->update([
                'status' => ConversionStatus::Completed,
                'output_path' => $outputRelativePath,
                'output_size' => $result->fileSize,
                'duration_ms' => $result->durationMs,
            ]);

            ConversionCompleted::dispatch($conversion);

            Log::info("Conversion #{$conversion->id} completed", [
                'duration_ms' => $result->durationMs,
                'output_size' => $result->fileSize,
            ]);

        } catch (\Exception $e) {
            $conversion->update([
                'status' => ConversionStatus::Failed,
                'error_message' => $e->getMessage(),
            ]);

            ConversionFailed::dispatch($conversion);

            Log::error("Conversion #{$conversion->id} failed", [
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error("ConvertFileJob permanently failed for conversion #{$this->conversionId}", [
            'error' => $exception->getMessage(),
        ]);
    }
}
