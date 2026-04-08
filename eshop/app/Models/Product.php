<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'active',
        'name',
        'description',
        'quantity',
        'price',
        'rating',
        'review_count'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
