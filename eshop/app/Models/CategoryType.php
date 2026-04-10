<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryType extends Model
{
    protected $table = 'category_types';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);

    }
}
