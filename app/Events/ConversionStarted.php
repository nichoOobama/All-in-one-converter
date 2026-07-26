<?php

namespace App\Events;

use App\Models\Conversion;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConversionStarted
{
    use Dispatchable, SerializesModels;

    public function __construct(public Conversion $conversion) {}
}
