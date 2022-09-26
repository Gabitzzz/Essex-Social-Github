<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostDislikeController extends Controller
{
    public function toggle(Post $post) {
        $post->dislikes()->toggle(auth()->id());

        DB::table('likes')->where('post_id', $post->id)
            ->where('user_id', auth()->id())->delete();

        return redirect()->back();
    }
}
