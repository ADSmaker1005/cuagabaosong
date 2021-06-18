<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;
    protected $table = 'product_option';
    protected $guarded = [];

    public function Category()
    {
        return $this->hasOne(ProductOptionCategories::class,'id','category');
    }
}
