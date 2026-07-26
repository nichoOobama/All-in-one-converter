<?php

namespace App\Converters;

use App\Contracts\ConverterInterface;
use App\DTOs\ConversionRequest;
use App\DTOs\ConversionResult;
use App\Enums\FileCategory;
use RuntimeException;

class AudioConverter implements ConverterInterface
{
    private string $ffmpeg;

    public function __construct()
    {
        $this->ffmpeg = config('converter.drivers.ffmpeg', 'ffmpeg');
    }

    public function convert(ConversionRequest $request, string $sourcePath, string $outputDir): ConversionResult
    {
        $start = microtime(true);

        $outputFilename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME)
            . '.' . $request->targetFormat;

        $outputPath = $outputDir . '/' . $outputFilename;

        $extensionsToMime = [
            'mp3' => 'audio/mpeg', 'wav' => 'audio/wav', 'flac' => 'audio/flac',
            'aac' => 'audio/aac', 'ogg' => 'audio/ogg', 'm4a' => 'audio/mp4',
            'wma' => 'audio/x-ms-wma',
        ];

        $targetMime = $extensionsToMime[$request->targetFormat] ?? 'audio/' . $request->targetFormat;

        $cmd = $this->ffmpeg . ' -y -i ' . escapeshellarg($sourcePath);

        $bitrate = $request->options['bitrate'] ?? '192k';
        $sampleRate = $request->options['sample_rate'] ?? null;

        switch ($request->targetFormat) {
            case 'mp3':
                $cmd .= " -codec:a libmp3lame -b:a {$bitrate}";
                break;
            case 'aac':
            case 'm4a':
                $cmd .= " -codec:a aac -b:a {$bitrate}";
                break;
            case 'ogg':
                $cmd .= " -codec:a libvorbis -b:a {$bitrate}";
                break;
            case 'flac':
                $cmd .= " -codec:a flac";
                break;
            case 'wav':
                $cmd .= " -codec:a pcm_s16le";
                break;
            case 'wma':
                $cmd .= " -codec:a wmav2 -b:a {$bitrate}";
                break;
        }

        if ($sampleRate) {
            $cmd .= " -ar {$sampleRate}";
        }

        if (isset($request->options['start_time'])) {
            $cmd .= " -ss " . escapeshellarg($request->options['start_time']);
        }

        if (isset($request->options['duration'])) {
            $cmd .= " -t " . escapeshellarg($request->options['duration']);
        }

        $cmd .= " -vn " . escapeshellarg($outputPath) . ' 2>&1';

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            throw new RuntimeException(
                "FFmpeg audio conversion failed (code {$returnCode}): " . implode("\n", array_slice($output, -5))
            );
        }

        if (!file_exists($outputPath)) {
            throw new RuntimeException("Output file not created: {$outputPath}");
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
        return ['mp3', 'wav', 'flac', 'aac', 'ogg', 'm4a', 'wma'];
    }

    public function category(): FileCategory
    {
        return FileCategory::Audio;
    }

    public function canConvert(string $sourceExtension, string $targetExtension): bool
    {
        return in_array($sourceExtension, $this->supportedFormats())
            && in_array($targetExtension, $this->supportedFormats());
    }
}
