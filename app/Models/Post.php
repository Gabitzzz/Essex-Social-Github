<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

//
//    protected $appends = [
//        'liked', 'disliked', 'unliked','undisliked'
//    ];

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

//    public function getLikedAttribute() {
//        return $this->likes()->where('like', 1)
//            ->where('likeable_id', $this->id)
//            ->where('likeable_type', get_class($this))
//            ->count();
//    }
    public function getUnLikedAttribute() {
        return $this->likes()->where('like_id', auth()->id());
    }
//
//    public function getdislikedAttribute() {
//        return $this->likes()->where('dislike', 1)
//            ->where('likeable_id', $this->id)
//            ->where('likeable_type', get_class($this))
//            ->count();
//    }
//
//    public function getUndislikedAttribute() {
//        return $this->likes()->where('dislike', 1)
//            ->where('likeable_id', $this->id)
//            ->where('likeable_type', get_class($this))
//            ->count();
//    }


}
