<?php

namespace App\Enums;

enum FileCategory: string
{
    case Image = 'image';
    case Video = 'video';
    case Audio = 'audio';
    case Document = 'document';
    case Spreadsheet = 'spreadsheet';
    case Presentation = 'presentation';
    case Archive = 'archive';

    public function label(): string
    {
        return match ($this) {
            self::Image => 'Image',
            self::Video => 'Video',
            self::Audio => 'Audio',
            self::Document => 'Document',
            self::Spreadsheet => 'Spreadsheet',
            self::Presentation => 'Presentation',
            self::Archive => 'Archive',
        };
    }

    public function maxSizeBytes(): int
    {
        return match ($this) {
            self::Image => 50_000_000,
            self::Video => 2_000_000_000,
            self::Audio => 200_000_000,
            self::Document => 100_000_000,
            self::Spreadsheet => 50_000_000,
            self::Presentation => 100_000_000,
            self::Archive => 500_000_000,
        };
    }

    public static function fromMimeType(string $mimeType): self
    {
        $map = [
            'image/' => self::Image,
            'video/' => self::Video,
            'audio/' => self::Audio,
            'application/pdf' => self::Document,
            'application/msword' => self::Document,
            'application/vnd.openxmlformats-officedocument' => self::Document,
            'application/vnd.oasis.opendocument' => self::Document,
            'application/vnd.ms-excel' => self::Spreadsheet,
            'text/csv' => self::Spreadsheet,
            'text/tab-separated-values' => self::Spreadsheet,
            'application/vnd.ms-powerpoint' => self::Presentation,
            'application/zip' => self::Archive,
            'application/gzip' => self::Archive,
            'application/x-tar' => self::Archive,
            'application/vnd.rar' => self::Archive,
            'application/x-7z-compressed' => self::Archive,
        ];

        foreach ($map as $pattern => $category) {
            if (str_starts_with($mimeType, $pattern)) {
                return $category;
            }
        }

        if (str_contains($mimeType, 'officedocument.wordprocessingml')) return self::Document;
        if (str_contains($mimeType, 'officedocument.spreadsheetml')) return self::Spreadsheet;
        if (str_contains($mimeType, 'officedocument.presentationml')) return self::Presentation;

        return self::Document;
    }
}
