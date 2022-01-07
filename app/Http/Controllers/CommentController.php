<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request, Post $post)
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
            'post_id' => 'nullable',
        ]);

        auth()->user()->comments()->create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'body' => $attributes['body'],

        ]);
        return Redirect::route('post.show', $post->id)->with('success', 'Comment posted.');
    }
}
