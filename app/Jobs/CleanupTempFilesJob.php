<?php

namespace App\Jobs;

use App\Services\TemporaryFileManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CleanupTempFilesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public int $timeout = 300;

    public function handle(TemporaryFileManager $tempManager): void
    {
        $cleaned = $tempManager->cleanupExpired();

        Log::info("Temp file cleanup completed", ['directories_cleaned' => $cleaned]);
    }
}
