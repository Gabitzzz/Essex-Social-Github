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
        $degreePost = DegreePost::with('user')
            ->where("degree_id", "=", $degree->id)
            ->with('likes')
            ->with('dislikes')
            ->with('user')
            ->latest()
            ->get()->all();

        $users = User::all()->where('degree', '=', $degree->id);


        return Inertia::render('Degree/Index', [
            'degree' => $degree,
            'posts' => $degreePost,
            'users' => $users,
        ]);
    }

    public function members(Degree $degree)
    {
        $users = User::all()->where('degree', '=', $degree->id);

        return Inertia::render('Degree/Members', [
            'degree' => $degree,
            'users' => $users,
        ]);
    }
}
