<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DailyConversionLimitExceeded extends Exception
{
    public function __construct(string $message = '')
    {
        if ($message === '') {
            $message = 'Batas harian ' . config('converter.limits.per_user_daily') . ' konversi tercapai. Beli Single (reset 1x) atau Subscription (unlimited) untuk lanjut.';
        }
        parent::__construct($message);
    }

    public function render(): Response
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], 429);
    }
}