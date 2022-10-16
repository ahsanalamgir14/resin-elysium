<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    function getLastVisitedAttribute($value){
        return Carbon::parse($value)->format('d-m-y');
    }
}
