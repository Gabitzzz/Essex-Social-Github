<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreeComment extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $fillable = ['degree_post_id'];


    public function post() {
        return $this->belongsTo(DegreePost::class, 'degree_post_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
