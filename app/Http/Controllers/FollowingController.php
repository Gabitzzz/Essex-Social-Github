<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FollowingController extends Controller
{

    public function index(User $user)
    {
        return Inertia::render('Follow/Following', [
            'followToggle' => $user->followers()->where('follower_id', auth()->id())->exists(),
            'followings' => $user->followings()->withCount([
                'followers as following' => function($q) {
                    return $q->where('follower_id', auth()->id());
                }
            ])->withCasts(['following' => 'boolean'])
                ->paginate(),
            'profile' => [
                'user' => $user
            ]
        ]);
    }

    public function store(User $user, $id)
    {
        $user->followings()->attach($id);
        return redirect()->back();
    }

    public function destroy(User $user, $id)
    {
        $user->followings()->detach($id);
        return redirect()->back();
    }

}

