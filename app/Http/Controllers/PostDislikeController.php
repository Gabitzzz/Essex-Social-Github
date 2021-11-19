<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostDislikeController extends Controller
{
    public function toggle(Post $post) {
        $post->dislikes()->toggle(auth()->id());
        return redirect()->back();
    }
}
