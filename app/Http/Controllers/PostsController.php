<?php

namespace App\Http\Controllers;

use App\Events\SomeonePostedEvent;
use App\Http\Requests\PostFormRequest;
use App\Http\Requests\StoreImage;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Notifications\SomeonePosted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use function GuzzleHttp\Promise\all;

class PostsController extends Controller
{

    public function index(Post $post)
    {
//        $post=Post::all();

//        dd($comments);



        return Inertia::render('Posts/Index', [
            'post' => Post::with('user')->where("id", "=", $post->id)->with('likes')->with('dislikes')->with('user')->get()->first(),
            'comments' => Comment::with('post')->where("post_id", "=", $post->id)->with('user')->latest()->get(),
//            'posts' => Post::with('user')->where("user_id", "=", $user->id)->get(),

        ]);
    }

    public function likes(Post $post)
    {
        return Inertia::render('Posts/Likes', [
            'post' => Post::with('user')->where("id", "=", $post->id)
                ->with('likes')
                ->with('dislikes')
//                ->with('comments')

                ->get()->first(),
            'comments' => Comment::with('post')->where("post_id", "=", $post->id)->with('user')->latest()->get(),

        ]);
    }

    public function dislikes(Post $post)
    {
        return Inertia::render('Posts/Dislikes', [
            'post' => Post::with('user')->where("id", "=", $post->id)
                ->with('likes')
                ->with('dislikes')
                ->get()->first(),
            'comments' => Comment::with('post')->where("post_id", "=", $post->id)->with('user')->latest()->get(),
        ]);
    }


    public function comments(Post $post)
    {
        return Inertia::render('Posts/Comment', [
            'post' => Post::with('user')->where("id", "=", $post->id)
                ->with('likes')
                ->with('dislikes')
                ->get()->first(),
            'comments' => Comment::with('post')->where("post_id", "=", $post->id)->with('user')->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }


    public function store(StoreImage $request)
    {
        $image_path = '';
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'location' => 'nullable|max:255',
            'image' => 'nullable|image',
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
        ]);

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('post', 'public');
        }

        Post::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body'],
            'location' => $attributes['location'],
            'image' => $image_path,
        ]);


//        NOTIFICATIONS
//        $user = User::where('id', auth()->id())->first();
//        $user->notify(new SomeonePosted($user, auth()->user()));
//        event(new SomeonePostedEvent($user, auth()->user()));

        return Redirect::route('home');
    }

    public function edit(Post $post)
    {

        if (auth()->user()->id != $post->user_id) {
            return back()->withErrors(['message' => 'You do not have permission to delete this post!']);
        } else {
            return Inertia::render('Posts/Edit', [
                'post' => Post::with('user')->where("id", "=", $post->id)->get()->first(),
            ]);
        }
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
