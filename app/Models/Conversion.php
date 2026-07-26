<?php

namespace App\Models;

use App\Enums\ConversionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'source_filename',
        'source_mime_type',
        'source_extension',
        'source_size',
        'target_extension',
        'category',
        'status',
        'error_message',
        'output_path',
        'output_size',
        'duration_ms',
        'options',
        'ip_address',
    ];

    protected $casts = [
        'source_size' => 'integer',
        'output_size' => 'integer',
        'duration_ms' => 'integer',
        'options' => 'array',
        'status' => ConversionStatus::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function isCompleted(): bool
    {
        return $this->status === ConversionStatus::Completed;
    }

    public function isFailed(): bool
    {
        return $this->status === ConversionStatus::Failed;
    }

    public function isProcessing(): bool
    {
        return $this->status === ConversionStatus::Processing;
    }

    public function isPending(): bool
    {
        return $this->status === ConversionStatus::Pending;
    }
}
