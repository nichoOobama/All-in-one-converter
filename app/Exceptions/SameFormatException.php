<?php

namespace App\Exceptions;

use RuntimeException;

class SameFormatException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Source and target formats are the same. No conversion needed.');
    }
}
