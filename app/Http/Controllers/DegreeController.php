<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\DegreePost;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;

class DegreeController extends Controller
{
    //

    public function index(Degree $degree)
    {
        $degreePost = DegreePost::with('user')->where('degree_id', '=', $degree->id)->with('likes')->get()->all();

        $users = User::where('degree', '=', $degree->id)->get()->all();


        return Inertia::render('Degree/Index', [
            'degree' => $degree,
            'users' => $users,
            'posts' => $degreePost,
        ]);
    }
}
