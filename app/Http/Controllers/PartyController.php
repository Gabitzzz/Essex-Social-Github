<?php

namespace App\Http\Controllers;

use App\Events\SomeonePostedEvent;
use App\Http\Requests\StoreImage;
use App\Models\Party;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PartyController extends Controller
{
    public function index(User $user)
    {
        $parties = Party::select('parties.*')->latest()->get()->all();
        return Inertia::render('Party/Index', [
            'parties' => $parties,


        ]);
    }

    public function create(User $user)
    {

        $followers = User::orderBy('id', 'desc')
            ->paginate(5);

        return Inertia::render('Party/Create', [
            'user' => $user,
            'followers' => $followers
        ]);
    }

        public function store(StoreImage $request)
    {


        $attributes = request()->validate([
            'body' => 'required|max:255',
            'title' => 'required|max:255',
            'date' => 'required|max:255',
            'partyImg' => 'nullable|image',
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
        ]);

        $image_path = '';

        if ($request->hasFile('partyImg')) {
            $image_path = $request->file('partyImg')->store('party', 'public');
        }


        {
            Party::create([
            'user_id' => auth()->id(),
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'date' => $attributes['date'],
            'partyImg' => $image_path,
//            'image'=> $imagePath,
        ]);
        $user = User::where('id', auth()->id())->first();
//        $user->notify(new SomeonePosted($user, auth()->user()));
        event(new SomeonePostedEvent($user, auth()->user()));
        return Redirect::route('home');
    }

    }
}
