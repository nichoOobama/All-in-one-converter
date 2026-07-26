<?php

namespace App\Events;

use App\Models\Conversion;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConversionFailed
{
    use Dispatchable, SerializesModels;

    public function __construct(public Conversion $conversion) {}
}
