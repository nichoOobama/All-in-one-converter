<?php

namespace App\Converters;

use App\Contracts\ConverterInterface;
use App\DTOs\ConversionRequest;
use App\DTOs\ConversionResult;
use App\Enums\FileCategory;
use RuntimeException;

class VideoConverter implements ConverterInterface
{
    private string $ffmpeg;
    private string $ffprobe;

    public function __construct()
    {
        $this->ffmpeg = config('converter.drivers.ffmpeg', 'ffmpeg');
        $this->ffprobe = config('converter.drivers.ffprobe', 'ffprobe');
    }

    public function convert(ConversionRequest $request, string $sourcePath, string $outputDir): ConversionResult
    {
        $start = microtime(true);

        $outputFilename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME)
            . '.' . $request->targetFormat;

        $outputPath = $outputDir . '/' . $outputFilename;

        $extensionsToMime = [
            'mp4' => 'video/mp4', 'avi' => 'video/x-msvideo', 'mkv' => 'video/x-matroska',
            'mov' => 'video/quicktime', 'webm' => 'video/webm', 'flv' => 'video/x-flv',
            'wmv' => 'video/x-ms-wmv', 'gif' => 'image/gif',
        ];

        $targetMime = $extensionsToMime[$request->targetFormat] ?? 'video/' . $request->targetFormat;

        $cmd = $this->ffmpeg . ' -y -i ' . escapeshellarg($sourcePath);

        if ($request->targetFormat === 'gif') {
            $fps = $request->options['fps'] ?? 10;
            $width = $request->options['width'] ?? 480;
            $cmd .= " -vf \"fps={$fps},scale={$width}:-1:flags=lanczos\"";
            $cmd .= " -loop 0";
        } else {
            $codec = $request->options['codec'] ?? ($request->targetFormat === 'webm' ? 'libvpx' : 'libx264');
            $quality = $request->options['crf'] ?? 23;

            $cmd .= " -c:v {$codec}";
            $cmd .= " -crf {$quality}";

            if ($request->targetFormat === 'webm') {
                $cmd .= " -b:v 1M -c:a libopus";
            } else {
                $cmd .= " -preset " . ($request->options['preset'] ?? 'medium');
                $cmd .= " -c:a aac";
                $cmd .= " -b:a 128k";
            }
        }

        if (isset($request->options['start_time'])) {
            $cmd .= " -ss " . escapeshellarg($request->options['start_time']);
        }

        if (isset($request->options['duration'])) {
            $cmd .= " -t " . escapeshellarg($request->options['duration']);
        }

        $cmd .= ' ' . escapeshellarg($outputPath) . ' 2>&1';

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            throw new RuntimeException(
                "FFmpeg conversion failed (code {$returnCode}): " . implode("\n", array_slice($output, -5))
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
        return ['mp4', 'avi', 'mkv', 'mov', 'webm', 'flv', 'wmv', 'gif'];
    }

    public function category(): FileCategory
    {
        return FileCategory::Video;
    }

    public function canConvert(string $sourceExtension, string $targetExtension): bool
    {
        return in_array($sourceExtension, $this->supportedFormats())
            && in_array($targetExtension, $this->supportedFormats());
    }
}
