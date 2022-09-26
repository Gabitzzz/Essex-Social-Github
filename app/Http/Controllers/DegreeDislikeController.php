<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\DegreePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DegreeDislikeController extends Controller
{
    //$degreePost
    public function toggle($id)
    {
        $degreePost = DegreePost::where('id', $id)->first();
        $degreePost->dislikes()->toggle(auth()->id());

        DB::table('degree_likes')->where('degree_post_id', $id)
            ->where('user_id', auth()->id())->delete();

        return redirect()->back();
    }

}
