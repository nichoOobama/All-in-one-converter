<?php

namespace App\Services;

use App\Contracts\FileValidatorInterface;
use App\DTOs\ConversionRequest;
use App\Enums\FileCategory;
use App\Exceptions\FileTooLargeException;
use App\Exceptions\SameFormatException;
use App\Exceptions\UnsupportedFormatException;

class FileValidator implements FileValidatorInterface
{
    public function validate(ConversionRequest $request): void
    {
        $mimeType = mime_content_type($request->file->getRealPath());

        if ($mimeType === false) {
            throw new \InvalidArgumentException('Unable to determine file type.');
        }

        $category = $request->category;
        $maxSize = $category->maxSizeBytes();

        if ($request->file->getSize() > $maxSize) {
            throw new FileTooLargeException($maxSize, $category);
        }

        $supportedFormats = $this->getSupportedTargets($category);

        if (!in_array($request->targetFormat, $supportedFormats)) {
            throw new UnsupportedFormatException($request->targetFormat, $category);
        }

        $sourceMimeTypes = config('converter.mime_types.' . $category->value, []);

        if (!empty($sourceMimeTypes) && !in_array($mimeType, $sourceMimeTypes)) {
            throw new \InvalidArgumentException(
                "MIME type '{$mimeType}' does not match category '{$category->value}'."
            );
        }
    }

    public function detectCategory(string $mimeType): FileCategory
    {
        return FileCategory::fromMimeType($mimeType);
    }

    public function getSupportedTargets(FileCategory $category): array
    {
        return config('converter.formats.' . $category->value, []);
    }
}
