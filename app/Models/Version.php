<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Version extends Model
{
    protected $fillable = [
        'version_number',
        'platform',
        'download_url',
        'changelog',
        'is_critical',
        'force_update',
        'min_supported_version',
        'file_size',
        'file_hash',
        'is_active',
    ];

    protected $casts = [
        'is_critical' => 'boolean',
        'force_update' => 'boolean',
        'is_active' => 'boolean',
        'file_size' => 'integer',
        'changelog' => 'array',
    ];

    public function scopeLatestForPlatform(Builder $query, string $platform): Builder
    {
        return $query->where('platform', $platform)
                     ->where('is_active', true)
                     ->orderByDesc('created_at');
    }

    public function getIsNewerThan(string $otherVersion): bool
    {
        return version_compare($this->version_number, $otherVersion, '>');
    }

    public function getIsOlderThan(string $otherVersion): bool
    {
        return version_compare($this->version_number, $otherVersion, '<');
    }
}
