<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "order_items";
    protected $casts = [
        'images' => 'array',
        'quotes' => 'array'
    ];
    protected $guarded = [];
    protected $fillable = [
        // 'id',
        'order_id',
        // 'product_id',
        // 'price',
        // 'qty',
        'order_quote_id',
        'name',
        'main_image',
        // 'category_id',
        'slug',
        'type',
        'SKU',
        'price',
        'qty',
        // '3d_model',
        // 'is_trending',
        // 'is_best_seller',
        // 'status',
        'images',
        'no_of_quotes',
        'quotes'
    ];

    public function quote(){
        return $this->belongsTo('App\Models\OrderQuote','order_quote_id','id');
    }
    // public function Product(){
    //     return $this->belongsTo('App\Models\Product','product_id','id');
    // }
}
