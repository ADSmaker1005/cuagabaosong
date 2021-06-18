<?php

namespace App\Models;

use App\Models\MainSettings\District;
use App\Models\MainSettings\Province;
use App\Models\MainSettings\Street;
use App\Models\MainSettings\Ward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bill';
    protected $guarded = [];

    public function Carts()
    {
        return $this->hasMany(Cart::class,'bill_id','id');
    }

    public function Province()
    {
        return $this->hasOne(Province::class,'id','province');
    }
    public function District()
    {
        return $this->hasOne(District::class,'id','district');
    }

    public function Ward()
    {
        return $this->hasOne(Ward::class,'id','ward');
    }

    public function Street()
    {
        return $this->hasOne(Street::class,'id','street');
    }
}
