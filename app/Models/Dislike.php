<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Post;
use App\Models\User;

class Dislike extends Model
{
    use HasFactory;
    public function dislikes(){
        return $this->belongsTo(Post::class)->withDefault();
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
