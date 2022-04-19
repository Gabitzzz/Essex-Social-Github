<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\DegreeComment;
use App\Models\DegreePost;
use App\Models\Post;
use App\Models\User;
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


    public function store($degreePostId)
    {

//        $degreePost = DegreePost::with('degree')->where('id', '=', $degree->id)->get()->first();

//        dd($degreePost);

        $attributes = request()->validate([
            'body' => 'required|max:255',
//            'post_id' => DegreePost,
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
        ]);

        auth()->user()->degreeComments()->create([
            'user_id' => auth()->id(),
            'degree_post_id'=> $degreePostId,
            'body' => $attributes['body'],

        ]);


         return Redirect::back();
    }
}
