<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_key',
        'type',
        'status',
        'used_at',
        'expires_at',
    ];

    protected $casts = [
        'used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && !$this->used_at;
    }

    public function isUsed(): bool
    {
        return $this->status === 'used' || $this->used_at !== null;
    }

    public function isExpired(): bool
    {
        if ($this->type === 'single') {
            return false;
        }
        return $this->expires_at && $this->expires_at->isPast();
    }

    public static function generateKey(): string
    {
        $blocks = [];
        for ($i = 0; $i < 4; $i++) {
            $blocks[] = strtoupper(bin2hex(random_bytes(2)));
        }
        return implode('-', $blocks);
    }
}
