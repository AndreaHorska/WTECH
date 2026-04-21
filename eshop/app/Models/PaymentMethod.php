<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'fee',
        'icon_key',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getIconEmojiAttribute(): string
    {
        return match ($this->icon_key) {
            'card' => '💳',
            'bank' => '🏦',
            'cash' => '🪙',
            default => '💰',
        };
    }
}
