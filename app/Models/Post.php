<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, "admin_id", "id");
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }


    public function liked($user_id = null, $liked = true)
    {
        $this->likes()->updateOrCreate([
            'user_id' => $user_id,
        ], [
            'liked' => $liked,
        ]);
    }

    public function dislike($user_id = null)
    {
        $this->liked($user_id, false);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
