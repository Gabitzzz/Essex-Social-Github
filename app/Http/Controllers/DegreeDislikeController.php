<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\DegreePost;
use App\Models\Post;
use Illuminate\Http\Request;

class DegreeDislikeController extends Controller
{
    //$degreePost
    public function toggle(DegreePost $degreePost) {


        dd($degreePost);

        $post = $degreePost::with('degree')->get()->last();
        $post->dislikes()->toggle(auth()->id());
        return redirect()->back();
    }

}
