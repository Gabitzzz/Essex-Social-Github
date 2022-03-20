<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;


    public function users(){
        return $this->belongsTo(User::class);
    }

    public function degreePosts(){
        return $this->belongsTo(DegreePost::class);
    }

    public function degreeLikes(){
        return $this->belongsTo(Degree::class);
    }
}
