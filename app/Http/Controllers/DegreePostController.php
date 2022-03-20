<?php

namespace App\Http\Controllers;

use App\Events\SomeonePostedEvent;
use App\Http\Requests\StoreImage;
use App\Models\Comment;
use App\Models\Degree;
use App\Models\DegreePost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class DegreePostController extends Controller
{


    public function index(Degree $degree, DegreePost $post)
    {

//        $degreePost = DegreePost::with('degree')->where('id', '=', $degree->id)->with('user')->with('degreeLikes')->get()->first();
        $degreePost = DegreePost::with('user')->where("id", "=", $post->id)->with('likes')->with('user')->get()->first();

        return Inertia::render('DegreePosts/Index', [
            'post' => $degreePost,

            'degree' => $degree,
//            'comments' => Comment::with('post')->where("post_id", "=", $post->id)->with('user')->latest()->get(),
//            'posts' => Post::with('user')->where("user_id", "=", $user->id)->get(),
        ]);
    }

    public function create(Degree $degree)
    {



        return Inertia::render('DegreePosts/Create', [
            'degree' => $degree,
        ]);
    }


    public function store(StoreImage $request, Degree $degree)
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'location' => 'nullable|max:255',
            'image' => 'nullable|image',
            'degree_id' => ['nullable', Rule::exists('degrees', 'id')->where(function ($query) {
                $query->where('degree_id', '=', 'id');
            })],
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
        ]);

        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('post', 'public');
        }



        DegreePost::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body'],
            'location' => $attributes['location'],
            'image' => $image_path,
            'degree_id' => $degree->id,
//            'image'=> $imagePath,
        ]);
        $user = User::where('id', auth()->id())->first();
//        $user->notify(new SomeonePosted($user, auth()->user()));
//        event(new SomeonePostedEvent($user, auth()->user()));
        return Redirect::route('degree.show', $degree->id);
    }

    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
//            'post' => [
//                'id' => $post->id,
//                'user_id' => $post->user_id,
//                'body' => $post->body,
//                'image' => $post->image,
////                'avatar' => $user->avatar ? URL::route('image', ['path' => $user->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
////                'cover' => $user->cover ? URL::route('image', ['path' => $user->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
////                'description' => $user->description,
//            ],
//        ]);
            'post' => Post::with('user')->where("id", "=", $post->id)->get()->first(),
        ]);
    }

    public function update(Post $post)
    {
        $attributes = request()->validate([
            'body' => ['string', 'max:255'],
            'location' => ['string', 'max:255'],
        ]);
        $post->update($attributes);
        return Redirect::route('home');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return Redirect::route('home');
    }


}
