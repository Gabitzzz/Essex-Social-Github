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
        return $this->belongsToMany(Party::class, 'party_invites', 'party_id', 'user_id')
            ->withTimestamps();
    }

}

