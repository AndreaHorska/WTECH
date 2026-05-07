<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'name',
        'description',
        'quantity',
        'price',
        'rating',
        'review_count',
        'pcs',
        'material',
        'size',
        'weight',
        'age',
        'country_of_origin'
    ];

    public static array $specs = [
        'pcs' => ['label' => 'Pcs per package', 'type' => 'number', 'min' => 1, 'max' => 99999,],
        'material' => ['label' => 'Material', 'maxlength' => 50],
        'size' => ['label' => 'Size', 'maxlength' => 50],
        'weight' => ['label' => 'Weight', 'maxlength' => 30],
        'age' => ['label' => 'Age', 'maxlength' => 20],
        'country_of_origin'=> ['label' => 'Country of origin', 'maxlength' => 60],
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'product_category',
            'product_id',
            'category_id'
        );
    }
}
