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
                'user' => $user,
            ],
            'can' => [
                'edit_user' => Auth::user()->can('users.edit', $user),
            ],
            'followings' => $user->followings()->withCount([
                'followers as following' => function ($q) {
                    return $q->where('follower_id', auth()->id());
                },

            ])->withCasts(['following' => 'boolean'])
                ->paginate(),

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

            'dob' => ['nullable', 'max:50'],
            'type' => ['nullable', 'max:50'],
            'study_year' => ['nullable', 'max:50'],
            'degree' => ['nullable', 'max:50'],
        ]);

        if ($request->hasFile('avatar')) {
            $avatar_path = $request->file('avatar')->store('avatar', 'public');
        }

        if ($request->hasFile('cover')) {
            $cover_path = $request->file('cover')->store('cover', 'public');
        }

        Auth::user()->account->users()->create([
            'name' => Request::get('name'),
            'username' => Request::get('username'),
            'email' => Request::get('email'),
            'description' => Request::get('description'),
            'avatar' => $avatar_path,
            'cover' => $cover_path,
            'password' => Request::get('password'),
        ]);
        return Redirect::route('profile');
    }

    public function edit(User $user)
    {
        if(auth()->user()->id != $user->id) {
            return back()->withErrors(['message' => 'You do not have permission to delete this post!']);
        }
        else{
            return Inertia::render('Profile/Edit', ['user' => auth()->user()]);
        }

    }

    public function update(User $user, StoreImage $request)
    {
        $attributes = request()->validate([
            'username' => ['required', 'max:50'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'max:50'],
            'description' => ['nullable', 'max:250'],
            'avatar' => ['file'],
            'cover' => ['file'],
        ]);
        if ($request->hasFile('avatar')) {
            $attributes['avatar'] = $request->file('avatar')
                ->store('avatar', 'public');
        }

        if ($request->hasFile('cover')) {
            $attributes['cover'] = $request->file('cover')
                ->store('cover', 'public');
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

    public function getInfo(User $user, Request $request)
    {
        $attributes = $request->validate([
            'dob' => 'nullable|string|max:50',
            'type' => 'nullable|string|max:10',
            'study_year' => 'nullable|string|max:10',
            'citizenship' => 'nullable|string|max:20',

        ]);


        return Inertia::render('Home/Info', [
            'user' => auth()->user(),
            'attributes' => $attributes,


        ]);

//        return Redirect::route('dashboard');


    }

    public function detailStore(Request $request, User $user)
    {

        Auth::user()->account->users()->create([
            'dob' => Request::get('dob'),
            'type' => Request::get('type'),
            'study_year' => Request::get('study_year'),
            'citizenship' => Request::get('citizenship'),
        ]);



        $attributes = $request->validate([
            'dob' => 'nullable|string|max:50',
            'type' => 'nullable|string|max:10',
            'study_year' => 'nullable|string|max:10',
            'citizenship' => 'nullable|string|max:20',
        ]);




        $user->save($attributes);
        $user->save();

        return Redirect::route('dashboard');
    }


}
