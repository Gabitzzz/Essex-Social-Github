<?php

namespace App\Http\Controllers;

use App\Events\SomeonePostedEvent;
use App\Http\Requests\StoreImage;
use App\Models\Comment;
use App\Models\Degree;
use App\Models\DegreeComment;
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


//        $posts = Post::whereIn('user_id', function ($query) use ($id) {
//            $query->select('followed_id')
//                ->from('following')
//                ->where('follower_id', $id);
//        })->orWhere('user_id', $id)
//            ->with('user')
//            ->with('likes')
//            ->with('dislikes')
//            ->latest()->get()->all();

//        $id = $post->id;

//        dd($id);

        $users = User::all()->where('degree', '=', $degree->id);


        return Inertia::render('DegreePosts/Index', [
            'post' => DegreePost::with('user')->where("id", "=", $post->id)->with('likes')->with('dislikes')->with('user')->get()->first(),

//            'user' => $user,
            'degree_id' => $degree,
            'comments' => DegreeComment::with('post')->where("degree_post_id", "=", $post->id)->with('user')->latest()->get(),
            'users' => $users
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

    public function edit(DegreePost $degreePost)
    {
        $degreePost = DegreePost::with('user')->where("id", "=", $degreePost->id)->with('likes')->with('dislikes')->with('user')->get()->first();

//        $post = DegreePost::with('user')->where('id', '=', $degreePost->id)->get()->first();
        dd($degreePost);


        return Inertia::render('DegreePosts/Edit', [
            'post' => DegreePost::with('user')->where("id", "=", $degreePost->id)->get()->first(),
        ]);
    }

    public function update(DegreePost $post)
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
