<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function licenses(): HasMany
    {
        return $this->hasMany(License::class);
    }

    public function conversions(): HasMany
    {
        return $this->hasMany(Conversion::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function hasActiveSubscription(): bool
    {
        return $this->licenses()
            ->where('type', 'subscription')
            ->where('status', '!=', 'expired')
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            })
            ->exists();
    }

    public function activeSingleLicensesCount(): int
    {
        return $this->licenses()
            ->where('type', 'single')
            ->where('status', 'active')
            ->whereNull('used_at')
            ->count();
    }

    public function hasActiveSingle(): bool
    {
        return $this->activeSingleLicensesCount() > 0;
    }

    /** Consume one active single license to reset daily limit. Returns consumed License or null. */
    public function consumeSingleForReset(): ?License
    {
        $license = $this->licenses()
            ->where('type', 'single')
            ->where('status', 'active')
            ->whereNull('used_at')
            ->oldest()
            ->first();

        if (!$license) {
            return null;
        }

        $license->update([
            'status' => 'used',
            'used_at' => now(),
        ]);

        return $license;
    }

    /** Get last single redemption time today, if any */
    public function lastSingleRedeemToday(): ?\Illuminate\Support\Carbon
    {
        $last = $this->licenses()
            ->where('type', 'single')
            ->where('status', 'used')
            ->whereNotNull('used_at')
            ->where('used_at', '>=', now()->startOfDay())
            ->latest('used_at')
            ->first();

        return $last?->used_at;
    }

    public function hasUnlimitedAccess(): bool
    {
        return $this->hasActiveSubscription();
    }

    public function getEffectiveDailyLimit(): int
    {
        if ($this->hasUnlimitedAccess()) {
            return PHP_INT_MAX;
        }
        if ($this->hasActiveSingle()) {
            return (int) config('converter.limits.single_daily', 20);
        }
        return (int) config('converter.limits.per_user_daily', 7);
    }

    public function getLimitTier(): string
    {
        if ($this->hasUnlimitedAccess()) return 'subscription';
        if ($this->hasActiveSingle()) return 'single';
        return 'free';
    }
}
