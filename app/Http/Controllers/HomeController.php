<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(User $user, Post $post)
    {

        $posts = Post::select('posts.*')
            ->with('dislikes')
            ->with('user')
            ->join('following', 'following.followed_id', '=', 'posts.user_id')
            ->with(['likes'])->get()->all();






//            ->with('users')->get()->all();
//        $users = Post::


//        $users = User::select('users.*')
//            ->join('posts', 'posts.user_id', '=', 'users.id')->get()->all();


        return Inertia::render('Home/Index', [
            'posts' => $posts,

//            'likeToggle' => Post::with('likes')->where("user_id", auth()->id())->exists(),



//            'check' => $check,


        ]);

    }
}

