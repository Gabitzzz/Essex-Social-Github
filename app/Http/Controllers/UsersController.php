<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImage;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;


class UsersController extends Controller
{
    public function index(User $user)
    {
        return Inertia::render('Profile/Show', [
            'user' => $user,
            'posts' => Post::with('user')->where("user_id", "=", $user->id)->with('likes')->with('dislikes')->get(),
            'followToggle' => $user->followers()->where('follower_id', auth()->id())->exists(),
            'followers' => $user->followers()->withCount([
                'followers as following' => function ($q) {
                    return $q->where('follower_id', auth()->id());
                }
            ])->withCasts(['following' => 'boolean'])
                ->paginate(),
            'profile' => [
                'user' => $user
            ],
            'followings' => $user->followings()->withCount([
                'followers as following' => function ($q) {
                    return $q->where('follower_id', auth()->id());
                }
            ])->withCasts(['following' => 'boolean'])
                ->paginate(),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ],


        ]);
    }

    public function store(StoreImage $request)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'username' => ['required', 'max:50'],
            'description' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['required'],
        ]);

        if ($request->hasFile('avatar')) {
            $avatar_path = $request->file('postImage')->store('post', 'public');
        }


        Auth::user()->account->users()->create([
            'name' => Request::get('name'),
            'username' => Request::get('username'),
            'email' => Request::get('email'),
            'description' => Request::get('description'),
            'avatar' => $avatar_path,
            'password' => Request::get('password'),
        ]);
        return Redirect::route('profile');
    }

    public function edit(User $user)
    {
        return Inertia::render('Profile/Edit', ['user' => auth()->user()]);
    }

    public function update(User $user, StoreImage $request)
    {

//        if ($request->hasFile('avatar')) {
//            $avatar_path = $request->file('avatar')->store('image', 'public');
//        }

        $attributes = request()->validate([
//            'avatar' => ['sometimes', 'max:1024'],
            'username' => ['required', 'max:50'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'max:50'],
            'photo' => ['nullable', 'image'],
            'description' => ['nullable', 'max:250'],
            'avatar' => ['file'],
        ]);

        if ($request->hasFile('avatar')) {
            $attributes['avatar'] = $request->file('avatar')
                ->store('avatar', 'public');
//            $user->update(['avatar' => $request->file('avatar')->storePublicly('image', 'public')]);
        }


        $user->update($attributes);
        return Redirect::route('dashboard');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::back()->with('success', 'User deleted.');
    }

    public function explore()
    {
        return Inertia::render('Explore/Index', [
            'users' => User::all()
        ]);
    }

    public function search()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:username, name']
        ]);
        $query = User::query();

        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
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
