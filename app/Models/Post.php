<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Likepost;
use App\Models\Dislike;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    // protected $table = 'posts';
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likeposts(){
        return $this->hasMany(Likepost::class);
    }

    public function dislikes(){
        return $this->hasMany(Dislike::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

}
