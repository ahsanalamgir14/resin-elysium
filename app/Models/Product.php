<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory, SoftDeletes;
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
        'is_trending',
        'is_best_seller',
        'status',
        'images',
        'desc',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // function sub_categories()
    // {
    //     return $this->hasMany(Category::class, 'id', 'dd');
    // }

    // public function sub_category_products()
    // {
    //     return $this->hasMany(Product::class, 'category_id');
    // }
}
