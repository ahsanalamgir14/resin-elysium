<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = "order_items";
    protected $casts = [];
    protected $guarded = [];
    protected $fillable = [
        // 'id',
        'order_id',
        'product_id',
        'price',
        'qty',
        'order_quote_id',
    ];

    public function Product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
