<?php

namespace App\Models\MainSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    use HasFactory;
    protected $table = 'themes';
    protected $guarded = [];
}
