<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $casts = [
        'images' => 'array',
    ];
    protected $guarded = [];
    protected $fillable = [
        'name',
        'main_image',
        'category_id',
        'slug',
        'type',
        'SKU',
        'price',
        'qty',
        '3d_model',
        'status',
        'images',
        'desc',
    ];
    function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
