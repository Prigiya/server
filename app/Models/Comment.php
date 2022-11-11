<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    // protected $table = 'comments';

    public function posts(){
        return $this->belongsTo(Post::class)->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
