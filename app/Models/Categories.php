<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        'sort_id',
        'locate',
        'showindex',
        'name',
        'slug',
        'icon',
        'title',
        'description',
        'keywords',
        'image',
        'text',
        'area',
        'type'
    ];

    public function childs()
    {
        return $this->hasMany(Categories::class, 'parent_id','id');
    }

    public function posts()
    {
        return $this->belongsToMany(Posts::class,'categories_posts','category_id','post_id');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class,'categories_products','category_id','product_id');
    }
}
