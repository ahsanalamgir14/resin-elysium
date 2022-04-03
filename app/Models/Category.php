<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image',
        'is_home',
        'status',
    ];
    function sub_categories(){
        return $this->hasMany(Category::class, 'parent_id');
    }
}
