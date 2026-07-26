<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface TemporaryFileManagerInterface
{
    public function store(UploadedFile $file, int $conversionId): string;

    public function getTempDir(int $conversionId): string;

    public function getOutputDir(int $conversionId): string;

    public function cleanup(int $conversionId): void;

    public function cleanupExpired(): int;
}
