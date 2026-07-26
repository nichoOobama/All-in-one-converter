<?php

namespace App\Exceptions;

use App\Enums\FileCategory;
use RuntimeException;

class UnsupportedFormatException extends RuntimeException
{
    public function __construct(string $format, FileCategory $category)
    {
        $supported = implode(', ', config('converter.formats.' . $category->value, []));
        parent::__construct(
            "Format '{$format}' is not supported for {$category->label()} conversion. " .
            "Supported: {$supported}"
        );
    }
}
