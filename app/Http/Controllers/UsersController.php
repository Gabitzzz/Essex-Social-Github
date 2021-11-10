<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index(User $user)
    {
        return Inertia::render('Profile/Show', [
            'user' => $user,
            'posts' => Post::with('user')->where("user_id", "=", $user->id)->get(),
            'followToggle' => $user->followers()->where('follower_id', auth()->id())->exists(),
            'followers' => $user->followers()->withCount([
                'followers as following' => function($q) {
                    return $q->where('follower_id', auth()->id());
                }
            ])->withCasts(['following' => 'boolean'])
                ->paginate(),
            'profile' => [
                'user' => $user
            ],
            'followings' => $user->followings()->withCount([
                'followers as following' => function($q) {
                    return $q->where('follower_id', auth()->id());
                }
            ])->withCasts(['following' => 'boolean'])
                ->paginate(),

        ]);
    }

    public function store()
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'username' => ['required', 'max:50'],
            'description' => ['required', 'max:50'],
            'avatar' => ['nullable', 'image'],
            'cover' => ['nullable', 'image'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['nullable'],
//            'owner' => ['required', 'boolean'],
//            'photo' => ['nullable', 'image'],
        ]);

        Auth::user()->account->users()->create([
            'name' => Request::get('name'),
            'username' => Request::get('username'),
            'email' => Request::get('email'),
            'description' => Request::get('description'),
            'avatar' => Request::get('avatar'),
            'cover' => Request::get('cover'),
            'password' => Request::get('password'),
//            'photo_path' => Request::file('photo') ? Request::file('photo')->store('users') : null,
        ]);
        return Redirect::route('profile');
    }

    public function edit(User $user)
    {
        return Inertia::render('Profile/Edit', [
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar ? URL::route('image', ['path' => $user->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
                'cover' => $user->cover ? URL::route('image', ['path' => $user->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
                'description' => $user->description,

            ]
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'username' => ['required', 'max:50'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable'],
//            'owner' => ['required', 'boolean'],
            'photo' => ['nullable', 'image'],
            'description' => ['nullable', 'max:250'],
        ]);

//        $user->update(\Illuminate\Support\Facades\Request::only('username', 'name', 'email'));
        $user->update($attributes);


//        if ((new \Illuminate\Http\Request)->get('password')) {
//            $user->update(['password' => Request::get('password')]);
//        }

//        return Redirect::back()->with('success', 'User updated.');
        return Redirect::route('dashboard');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::back()->with('success', 'User deleted.');
    }

    public function explore(){
        return Inertia::render('Explore/Index', [
            'users' => User::all()
        ]);
    }

    public function search(){

        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:username, name']
        ]);

        $query = User::query();

        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Search/Index', [
            'users' => $query->paginate()->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);

    }
}
