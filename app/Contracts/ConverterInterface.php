<?php

namespace App\Contracts;

use App\DTOs\ConversionRequest;
use App\DTOs\ConversionResult;
use App\Enums\FileCategory;

interface ConverterInterface
{
    public function convert(ConversionRequest $request, string $sourcePath, string $outputDir): ConversionResult;

    public function supportedFormats(): array;

    public function category(): FileCategory;

    public function canConvert(string $sourceExtension, string $targetExtension): bool;
}
