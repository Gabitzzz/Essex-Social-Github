<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $posts = Post::whereIn('user_id', function ($query) use ($id) {
            $query->select('followed_id')
                ->from('following')
                ->where('follower_id', $id);
        })->orWhere('user_id', $id)
            ->with('user')
            ->with('likes')
            ->with('dislikes')
            ->latest()->get()->all();
//
//        $posts = Post::select('posts.*')
//            ->with('user')
//            ->join('following', 'following.followed_id', '=', 'posts.user_id')
//            ->with('likes')
//            ->with('dislikes')
//            ->get()->all();


        return Inertia::render('Home/Index', [
            'posts' => $posts,
            'likeToggle' => Post::with('likes')->where('user_id', '=', auth()->id())->exists(),
        ]);

    }
}

