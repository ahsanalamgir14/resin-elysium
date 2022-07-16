<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parents()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    function sub_categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    // function products()
    // {
    //     // return $this->hasManyThrough('App\Product', 'App\children');
    //     DB::enableQueryLog();
    //     return $this->hasManyThrough(Category::class, Category::class, 'category_id', 'category_id', 'id', );
    //     dd(DB::getQueryLog());
    // }

    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'category_id');
    // }

    // public function products()
    // {
    //     return $this->hasManyThrough(
    //         Product::class,
    //         category::class,
    //         'parent_id', // Foreign key on the category table...
    //         'category_id', // Foreign key on the deployments table...
    //         'parent_id', // Local key on the category 2 table...
    //         'idd', // Local key on the category 1 table...
    //     );
    // }


    // public function products()
    // {
    //     return $this->hasManyThrough(
    //         Product::class,
    //         category::class,
    //         'parent_id', // Foreign key on the category table...
    //         'category_id', // Foreign key on the deployments table...
    //         'parent_id', // Local key on the category 2 table...
    //         'id', // Local key on the category 1 table...
    //     );
    // }
}
