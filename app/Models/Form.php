<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table ='form';
    protected $guarded =[];

    public function Product()
    {
        return $this->hasOne(Products::class,'id','product_id');
    }
}
