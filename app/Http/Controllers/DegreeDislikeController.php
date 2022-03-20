<?php

namespace App\Http\Controllers;

use App\Models\DegreePost;
use App\Models\Post;
use Illuminate\Http\Request;

class DegreeDislikeController extends Controller
{
    //
    public function toggle(DegreePost $degreePost) {
        $degreePost->dislikes()->toggle(auth()->id());
        return redirect()->back();
    }
}
