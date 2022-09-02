<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderQuote extends Model
{
    use HasFactory;
    protected $table = "order_quotes";
    protected $casts = [
        'quotes' => 'array',
    ];
    protected $guarded = [];
    protected $fillable = [
        // 'id',
        'no_of_quotes',
        'quotes',
    ];
}
