<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'timeAgo',
    ];

//    FOR EDITING PARTIES
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//    END

    public function users()
    {
        return $this->belongsToMany(User::class, 'parties');
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }


    public function invites()
    {
        return $this->hasMany(PartyInvite::class);
    }
}

