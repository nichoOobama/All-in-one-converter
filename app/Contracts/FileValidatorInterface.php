<?php

namespace App\Contracts;

use App\DTOs\ConversionRequest;
use App\Enums\FileCategory;

interface FileValidatorInterface
{
    public function validate(ConversionRequest $request): void;

    public function detectCategory(string $mimeType): FileCategory;

    public function getSupportedTargets(FileCategory $category): array;
}
