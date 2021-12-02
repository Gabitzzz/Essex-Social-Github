<?php

namespace App\Http\Controllers;

use App\Events\SomeoneLikedEvent;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Notifications\SomeoneLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostLikeController extends Controller
{
    public function toggle(Post $post, User $user)
    {
        $post->likes()->toggle(auth()->id());

        $user = User::where('id', auth()->id())->first();
        event(new SomeoneLikedEvent($user, auth()->user()));


//        dd(event(new SomeoneLikedEvent($user)));

//        return redirect()->back();
        return Redirect::back();


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
//        'likes' => $user->posts()

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
