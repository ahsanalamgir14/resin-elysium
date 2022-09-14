<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;
    protected $table = "prospects";
    protected $casts = [
        'ip_details' => 'array',
        'products' => 'array',
    ];
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'ip',
        'ip_details',
        'products',
        'last_visited',
    ];
}
