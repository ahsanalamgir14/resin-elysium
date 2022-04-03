<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'orders';

    public function User()
    {
        return $this->belongsTo('App\Models\admin\User','user_id','id');
    }
    public function order_status()
    {
        return $this->belongsTo('App\Models\admin\OrderStatus','order_status_id','id');
    }
    public function Payment()
    {
        return $this->belongsTo('App\Models\admin\Payment','payment_id','id');
    }
}
