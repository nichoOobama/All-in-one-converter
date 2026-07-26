<?php

namespace App\Services;

use App\Contracts\TemporaryFileManagerInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TemporaryFileManager implements TemporaryFileManagerInterface
{
    private string $disk;

    public function __construct()
    {
        $this->disk = config('converter.temp_disk', 'local');
    }

    public function store(UploadedFile $file, int $conversionId): string
    {
        $dir = $this->getTempDir($conversionId);
        $filename = $file->getClientOriginalName();

        Storage::disk($this->disk)->put(
            $dir . '/' . $filename,
            file_get_contents($file->getRealPath())
        );

        return $dir . '/' . $filename;
    }

    public function getTempDir(int $conversionId): string
    {
        return "conversions/{$conversionId}/input";
    }

    public function getOutputDir(int $conversionId): string
    {
        return "conversions/{$conversionId}/output";
    }

    public function cleanup(int $conversionId): void
    {
        $baseDir = "conversions/{$conversionId}";

        if (Storage::disk($this->disk)->exists($baseDir)) {
            $this->deleteDirectoryRecursive($baseDir);
        }
    }

    public function cleanupExpired(): int
    {
        $hours = config('converter.temp_lifetime_hours', 24);
        $cutoff = now()->subHours($hours);
        $cleaned = 0;

        $directories = Storage::disk($this->disk)->directories('conversions');

        foreach ($directories as $dir) {
            $lastModified = Storage::disk($this->disk)->lastModified($dir);
            if ($lastModified && $lastModified < $cutoff->timestamp) {
                $this->deleteDirectoryRecursive($dir);
                $cleaned++;
            }
        }

        return $cleaned;
    }

    private function deleteDirectoryRecursive(string $directory): void
    {
        $fullPath = Storage::disk($this->disk)->path($directory);

        if (is_dir($fullPath)) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($fullPath, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($files as $file) {
                if ($file->isDir()) {
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }

            rmdir($fullPath);
        }
    }
}
