<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "carts";
    protected $fillable = [
        'user_id',
        'product_id',
        'user_type',
        'qty',
    ];
    function sub_categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    function update_cart($data)
    {
        
    }
}
