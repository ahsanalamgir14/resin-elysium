<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'id',
        'payment_id',
        'order_id',
        'type',
        'currency',
        'account_no',
        'last_four',
        'desc',
        'status',
        // 'created_at',
        // 'updated_at',
    ];
}
