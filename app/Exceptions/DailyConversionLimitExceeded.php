<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;

class DailyConversionLimitExceeded extends Exception
{
    public function render(): Response
    {
        return response()->json([
            'error' => 'Daily conversion limit exceeded. You have reached the maximum of ' . config('converter.limits.per_user_daily') . ' conversions per day.',
        ], 429);

    }
}