<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $fillable = [
        'name',
        'fee',
        'icon_key',
        'eta_text',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getIconEmojiAttribute(): string
    {
        return match ($this->icon_key) {
            'home' => '🏠',
            'store' => '🏪',
            default => '📦',
        };
    }
}
