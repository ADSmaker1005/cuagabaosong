<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionCategories extends Model
{
    use HasFactory;
    protected $table = 'product_option_categories';
    protected $guarded = [];

    public function Options()
    {
        return $this->hasMany(ProductOption::class,'category','id');
    }
}
