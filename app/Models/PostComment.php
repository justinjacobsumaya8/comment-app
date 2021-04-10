<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $guarded = [];

    public function post()
    {
    	return $this->belongsTo(\App\Models\Post::class, 'post_id');
    }

    public function user()
    {
    	return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(\App\Models\PostComment::class, 'parent_id')->orderBy('created_at', 'DESC');
    }
}
