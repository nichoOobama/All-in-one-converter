<?php

namespace App\DTOs;

readonly class ConversionResult
{
    public function __construct(
        public string $outputPath,
        public string $outputFilename,
        public int $fileSize,
        public int $durationMs,
        public string $outputMimeType,
    ) {}
}
