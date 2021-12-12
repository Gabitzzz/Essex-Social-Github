<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'timeAgo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'posts');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }


    public function dislikes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'dislikes');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comments')->withTimestamps();

    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }


}
