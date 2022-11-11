<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Post;

class Dislike extends Model
{
    use HasFactory;
    public function dislikes(){
        return $this->belongsTo(Post::class)->withDefault();
    }
}
