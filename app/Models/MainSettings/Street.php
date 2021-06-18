<?php

namespace App\Models\MainSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;
    protected $table = 'street';
    protected $guarded = [];
}
