<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table ='products';
    protected $guarded = [];

    public function Categories()
    {
        return $this->belongsToMany(Categories::class,'categories_products','product_id','category_id');
    }

    public function OptionCategories()
    {
        return $this->belongsToMany(ProductOptionCategories::class,'product_options_products_pivot','product_id','product_options_id');
    }
}
