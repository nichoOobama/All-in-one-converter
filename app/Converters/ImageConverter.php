<?php

namespace App\Converters;

use App\Contracts\ConverterInterface;
use App\DTOs\ConversionRequest;
use App\DTOs\ConversionResult;
use App\Enums\FileCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ImageConverter implements ConverterInterface
{
    public function convert(ConversionRequest $request, string $sourcePath, string $outputDir): ConversionResult
    {
        $start = microtime(true);

        $outputFilename = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME)
            . '.' . $request->targetFormat;

        $outputPath = $outputDir . '/' . $outputFilename;

        $extensionsToMime = [
            'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png',
            'webp' => 'image/webp', 'gif' => 'image/gif', 'bmp' => 'image/bmp',
            'tiff' => 'image/tiff', 'ico' => 'image/x-icon',
        ];

        $targetMime = $extensionsToMime[$request->targetFormat] ?? 'image/' . $request->targetFormat;

        $image = imagecreatefromstring(file_get_contents($sourcePath));

        if ($image === false) {
            throw new \RuntimeException("Failed to load image: {$sourcePath}");
        }

        if (in_array($request->targetFormat, ['jpg', 'jpeg'])) {
            $background = imagecreatetruecolor(imagesx($image), imagesy($image));
            $white = imagecolorallocate($background, 255, 255, 255);
            imagefilledrectangle($background, 0, 0, imagesx($image), imagesy($image), $white);
            imagecopy($background, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
            imagedestroy($image);
            $image = $background;
        }

        $quality = $request->options['quality'] ?? 85;

        switch ($request->targetFormat) {
            case 'jpg':
            case 'jpeg':
                $result = imagejpeg($image, $outputPath, $quality);
                break;
            case 'png':
                $result = imagepng($image, $outputPath, (int) (9 - ($quality / 11)));
                break;
            case 'webp':
                $result = imagewebp($image, $outputPath, $quality);
                break;
            case 'gif':
                $result = imagegif($image, $outputPath);
                break;
            case 'bmp':
                $result = imagebmp($image, $outputPath);
                break;
            default:
                $result = imagejpeg($image, $outputPath, $quality);
                break;
        }

        imagedestroy($image);

        if (!$result) {
            throw new \RuntimeException("Failed to save image to: {$outputPath}");
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
        return ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'tiff', 'ico'];
    }

    public function category(): FileCategory
    {
        return FileCategory::Image;
    }

    public function canConvert(string $sourceExtension, string $targetExtension): bool
    {
        return in_array($sourceExtension, $this->supportedFormats())
            && in_array($targetExtension, $this->supportedFormats());
    }
}
