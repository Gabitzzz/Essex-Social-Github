<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikedPostsController extends Controller
{



    public function toggle(Post $post)
    {
        $post->likes()->toggle(auth()->id());
        return redirect()->back();
    }
}
