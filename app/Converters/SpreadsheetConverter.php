<?php

namespace App\Converters;

use App\Contracts\ConverterInterface;
use App\DTOs\ConversionRequest;
use App\DTOs\ConversionResult;
use App\Enums\FileCategory;
use RuntimeException;

class SpreadsheetConverter implements ConverterInterface
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
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xls' => 'application/vnd.ms-excel',
            'csv' => 'text/csv',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            'tsv' => 'text/tab-separated-values',
        ];

        $targetMime = $extensionsToMime[$request->targetFormat] ?? 'application/' . $request->targetFormat;

        $convertTo = $request->targetFormat;

        if ($request->targetFormat === 'tsv') {
            $convertTo = 'csv';
        }

        $cmd = $this->libreoffice . ' --headless --convert-to ' . escapeshellarg($convertTo);
        $cmd .= ' --outdir ' . escapeshellarg($outputDir);
        $cmd .= ' ' . escapeshellarg($sourcePath) . ' 2>&1';

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            throw new RuntimeException(
                "Spreadsheet conversion failed (code {$returnCode}): " . implode("\n", $output)
            );
        }

        $inputFilename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
        $outputFilename = $inputFilename . '.' . $request->targetFormat;
        $outputPath = $outputDir . '/' . $outputFilename;

        if ($request->targetFormat === 'tsv') {
            $csvPath = $outputDir . '/' . $inputFilename . '.csv';
            if (file_exists($csvPath)) {
                $content = file_get_contents($csvPath);
                $content = str_replace(',', "\t", $content);
                file_put_contents($outputPath, $content);
                unlink($csvPath);
            }
        }

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
        return ['xlsx', 'xls', 'csv', 'ods', 'tsv'];
    }

    public function category(): FileCategory
    {
        return FileCategory::Spreadsheet;
    }

    public function canConvert(string $sourceExtension, string $targetExtension): bool
    {
        return in_array($sourceExtension, $this->supportedFormats())
            && in_array($targetExtension, $this->supportedFormats());
    }
}
