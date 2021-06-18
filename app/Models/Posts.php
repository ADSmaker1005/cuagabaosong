<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['title','description','keywords','name','slug','locate','img','text','content'];

    public function Categories()
    {
        return $this->belongsToMany(Categories::class,'categories_posts','post_id','category_id');
    }
}
