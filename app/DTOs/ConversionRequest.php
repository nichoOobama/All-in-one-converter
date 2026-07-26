<?php

namespace App\DTOs;

use App\Enums\FileCategory;
use Illuminate\Http\UploadedFile;

readonly class ConversionRequest
{
    public function __construct(
        public UploadedFile $file,
        public string $sourceExtension,
        public string $targetFormat,
        public FileCategory $category,
        public array $options = [],
    ) {}

    public static function fromUpload(
        UploadedFile $file,
        string $targetFormat,
        array $options = [],
    ): self {
        $originalName = $file->getClientOriginalName();
        $sourceExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        $mimeType = mime_content_type($file->getRealPath());
        $category = FileCategory::fromMimeType($mimeType);

        return new self(
            file: $file,
            sourceExtension: $sourceExtension,
            targetFormat: strtolower($targetFormat),
            category: $category,
            options: $options,
        );
    }
}
