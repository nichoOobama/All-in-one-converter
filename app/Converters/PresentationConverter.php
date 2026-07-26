<?php

namespace App\Converters;

use App\Contracts\ConverterInterface;
use App\DTOs\ConversionRequest;
use App\DTOs\ConversionResult;
use App\Enums\FileCategory;
use RuntimeException;

class PresentationConverter implements ConverterInterface
{
    private string $libreoffice;

    public function __construct()
    {
        $this->libreoffice = config('converter.drivers.libreoffice', '/usr/bin/soffice');
    }

    public function convert(ConversionRequest $request, string $sourcePath, string $outputDir): ConversionResult
    {
        $start = microtime(true);

        $extensionsToMime = [
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'ppt' => 'application/vnd.ms-powerpoint',
            'odp' => 'application/vnd.oasis.opendocument.presentation',
            'pdf' => 'application/pdf',
        ];

        $targetMime = $extensionsToMime[$request->targetFormat] ?? 'application/' . $request->targetFormat;

        $cmd = $this->libreoffice . ' --headless --convert-to ' . escapeshellarg($request->targetFormat);
        $cmd .= ' --outdir ' . escapeshellarg($outputDir);
        $cmd .= ' ' . escapeshellarg($sourcePath) . ' 2>&1';

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            throw new RuntimeException(
                "Presentation conversion failed (code {$returnCode}): " . implode("\n", $output)
            );
        }

        $inputFilename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
        $outputFilename = $inputFilename . '.' . $request->targetFormat;
        $outputPath = $outputDir . '/' . $outputFilename;

        if (!file_exists($outputPath)) {
            $candidates = glob($outputDir . '/' . $inputFilename . '.*');
            if (!empty($candidates)) {
                $outputPath = $candidates[0];
                $outputFilename = basename($outputPath);
            } else {
                throw new RuntimeException("Output file not created. Tried: {$outputPath}");
            }
        }

        $durationMs = (int) ((microtime(true) - $start) * 1000);

        return new ConversionResult(
            outputPath: $outputPath,
            outputFilename: $outputFilename,
            fileSize: filesize($outputPath),
            durationMs: $durationMs,
            outputMimeType: $targetMime,
        );
    }

    public function supportedFormats(): array
    {
        return ['pptx', 'ppt', 'odp', 'pdf'];
    }

    public function category(): FileCategory
    {
        return FileCategory::Presentation;
    }

    public function canConvert(string $sourceExtension, string $targetExtension): bool
    {
        return in_array($sourceExtension, $this->supportedFormats())
            && in_array($targetExtension, $this->supportedFormats());
    }
}
