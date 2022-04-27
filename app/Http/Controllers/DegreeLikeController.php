<?php

namespace App\Http\Controllers;

use App\Events\SomeoneLikedEvent;
use App\Models\Degree;
use App\Models\DegreeDislike;
use App\Models\DegreeLike;
use App\Models\DegreePost;
use App\Models\Dislike;
use App\Models\Like;
use App\Models\User;
use App\Notifications\SomeoneLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DegreeLikeController extends Controller
{
    public function toggle($degreePostId)
    {
        $post = DegreePost::where("id", "=", $degreePostId)->get()->first();

//        $post = $degreePost::with('degree')->get()->first();
        $post->likes()->toggle(auth()->id());
        DB::table('degree_dislikes')->where('degree_post_id', $degreePostId)
            ->where('user_id', auth()->id())->delete();

        return Redirect::back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//
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
    public function store(Request $request, DegreePost $degreePost)
    {
//        'likes' => $user->posts()

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\DegreePost $degreePost
     * @return \Illuminate\Http\Response
     */
    public function show(DegreePost $degreePost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     *      * @param \App\Models\DegreePost $degreePost
     * @return \Illuminate\Http\Response
     */
    public function edit(DegreePost $degreePost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *      *      * @param \App\Models\DegreePost $degreePost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DegreePost $degreePost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     *      *      *      * @param \App\Models\DegreePost $degreePost

     * @return \Illuminate\Http\Response
     */
    public function destroy(DegreePost $degreePost)
    {
        //
    }
}
