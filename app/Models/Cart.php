<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $guarded=[];

    public function CartProductOptions()
    {
        return $this->belongsToMany(ProductOption::class,'carts_product_options_pivot','cart_id','product_option_id');
    }
}
