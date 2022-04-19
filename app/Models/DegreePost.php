<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreePost extends Model
{
    use HasFactory;

    protected $appends = [
        'timeAgo',
    ];

    protected $table = 'degree_posts';
    protected $primaryKey = 'id';
    protected $guarded = [];




//    FOR EDITING POSTS
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//    END

    public function users()
    {
        return $this->belongsToMany(User::class, 'degree_posts');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'degree_likes')->withTimestamps();
    }

    public function dislikes()
    {
        return $this->belongsToMany(User::class, 'degree_dislikes')->withTimestamps();
    }



    public function comments()
    {
        return $this->hasMany(DegreeComment::class, 'degree_comments')->withTimestamps();
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }


}
