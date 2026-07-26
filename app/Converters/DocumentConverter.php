<?php

namespace App\Converters;

use App\Contracts\ConverterInterface;
use App\DTOs\ConversionRequest;
use App\DTOs\ConversionResult;
use App\Enums\FileCategory;
use RuntimeException;

class DocumentConverter implements ConverterInterface
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
            'pdf' => 'application/pdf', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'doc' => 'application/msword', 'odt' => 'application/vnd.oasis.opendocument.text',
            'txt' => 'text/plain', 'html' => 'text/html', 'rtf' => 'application/rtf',
        ];

        $targetMime = $extensionsToMime[$request->targetFormat] ?? 'application/' . $request->targetFormat;

        if ($request->targetFormat === 'txt') {
            return $this->convertToText($request, $sourcePath, $outputDir, $start, $targetMime);
        }

        if ($request->targetFormat === 'html') {
            return $this->convertToHtml($request, $sourcePath, $outputDir, $start, $targetMime);
        }

        $cmd = $this->libreoffice . ' --headless --convert-to ' . escapeshellarg($request->targetFormat);
        $cmd .= ' --outdir ' . escapeshellarg($outputDir);
        $cmd .= ' ' . escapeshellarg($sourcePath) . ' 2>&1';

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            throw new RuntimeException(
                "LibreOffice conversion failed (code {$returnCode}): " . implode("\n", $output)
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

    private function convertToText(
        ConversionRequest $request,
        string $sourcePath,
        string $outputDir,
        float $start,
        string $targetMime
    ): ConversionResult {
        $inputFilename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
        $outputFilename = $inputFilename . '.txt';
        $outputPath = $outputDir . '/' . $outputFilename;

        $cmd = $this->libreoffice . ' --headless --convert-to txt';
        $cmd .= ' --outdir ' . escapeshellarg($outputDir);
        $cmd .= ' ' . escapeshellarg($sourcePath) . ' 2>&1';

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            throw new RuntimeException("Text conversion failed: " . implode("\n", $output));
        }

        if (!file_exists($outputPath)) {
            $candidates = glob($outputDir . '/' . $inputFilename . '.*');
            if (!empty($candidates)) {
                $outputPath = $candidates[0];
                $outputFilename = basename($outputPath);
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

    private function convertToHtml(
        ConversionRequest $request,
        string $sourcePath,
        string $outputDir,
        float $start,
        string $targetMime
    ): ConversionResult {
        $inputFilename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
        $outputFilename = $inputFilename . '.html';
        $outputPath = $outputDir . '/' . $outputFilename;

        $cmd = $this->libreoffice . ' --headless --convert-to html';
        $cmd .= ' --outdir ' . escapeshellarg($outputDir);
        $cmd .= ' ' . escapeshellarg($sourcePath) . ' 2>&1';

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            throw new RuntimeException("HTML conversion failed: " . implode("\n", $output));
        }

        if (!file_exists($outputPath)) {
            $candidates = glob($outputDir . '/' . $inputFilename . '.*');
            if (!empty($candidates)) {
                $outputPath = $candidates[0];
                $outputFilename = basename($outputPath);
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
        return ['pdf', 'docx', 'doc', 'odt', 'txt', 'html', 'rtf'];
    }

    public function category(): FileCategory
    {
        return FileCategory::Document;
    }

    public function canConvert(string $sourceExtension, string $targetExtension): bool
    {
        return in_array($sourceExtension, $this->supportedFormats())
            && in_array($targetExtension, $this->supportedFormats());
    }
}
