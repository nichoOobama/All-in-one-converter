<?php

namespace App\Exceptions;

use App\Enums\FileCategory;
use RuntimeException;

class FileTooLargeException extends RuntimeException
{
    public function __construct(int $maxBytes, FileCategory $category)
    {
        $maxMB = round($maxBytes / 1_000_000, 1);
        parent::__construct("File is too large for {$category->label()} conversion. Maximum size: {$maxMB}MB.");
    }
}
