<?php

namespace App\Http\Controllers;

use App\Models\DegreePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class DegreeCommentController extends Controller
{
    //
    public function index()
    {
        //
    }

    public function store(DegreePost $degreePost)
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
            'post_id' => 'nullable',
        ]);

        auth()->user()->degreeComments()->create([
            'user_id' => auth()->id(),
            'post_id' => $degreePost->id,
            'body' => $attributes['body'],

        ]);
        return Redirect::route('degree.post.show', $degreePost->id)->with('success', 'Comment posted.');
    }
}
