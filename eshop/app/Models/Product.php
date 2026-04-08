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
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
