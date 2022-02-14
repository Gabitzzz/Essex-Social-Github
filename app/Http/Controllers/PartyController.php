<?php

namespace App\Http\Controllers;

use App\Events\SomeonePostedEvent;
use App\Http\Requests\StoreImage;
use App\Models\Party;
use App\Models\PartyInvite;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PartyController extends Controller
{

    public function index()
    {
//        $parties = Party::with('invites')->latest()->get()->all();

        $parties = Party::select('parties.*')
            ->with('invites')
            ->with('user')
//            ->join('following', 'following.followed_id', '=', 'posts.user_id')
            ->latest()->get()->all();

        return Inertia::render('Party/Parties', [
            'parties' => $parties,
//            'post' => Post::with('user')->where("id", "=", $post->id)->with('likes')->with('dislikes')->with('user')->get()->first(),

//            'parties'=> Party::with('invites')->with('users')->latest()->get()->all(),
        ]);


    }

    public function display(Party $party, User $user)
    {
        $var = $party::with('invites')->where("id", "=", $party->id)->with('user')->get()->first();

        return Inertia::render('Party/Index', [
            'party' => $var,
            'inviteToggle' => $party->invites()->where('party_invites.user_id', auth()->id())->exists(),
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
            'description' => 'required|max:255',
            'title' => 'required|max:255',
            'date' => 'required|max:255',
            'location' => 'required|max:255',
            'time' => 'nullable|max:255',
            'partyImg' => 'nullable|image',
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
        ]);

//        DATE PARSE
        $date = $attributes['date'];
        $parsed_date = Carbon::parse($date)->format('d F');
        $parsed_time = Carbon::parse($date)->format('H:i');

        $image_path = '';
        if ($request->hasFile('partyImg')) {
            $image_path = $request->file('partyImg')->store('party', 'public');
        }

        {
            Party::create([
                'user_id' => auth()->id(),
                'title' => $attributes['title'],
                'description' => $attributes['description'],
                'location' => $attributes['location'],
                'date' => $parsed_date,
                'time' => $parsed_time,
                'partyImg' => $image_path,
//            'image'=> $imagePath,
            ]);
            $user = User::where('id', auth()->id())->first();
//        $user->notify(new SomeonePosted($user, auth()->user()));
            event(new SomeonePostedEvent($user, auth()->user()));
            return Redirect::route('party.show');
        }
    }

    public function edit(Party $party){
        return Inertia::render('Party/Edit', [
            'party' => Party::with('user')->where("id", "=", $party->id)->get()->first(),
            ]);
    }

    public function update(Party $party, StoreImage $request)
    {
        $attributes = request()->validate([
            'title' => ['string', 'max:255'],
            'description' => ['string', 'max:255'],
            'location' => ['string', 'max:255'],

            'partyImg' => ['nullable','file'],
        ]);
        $time_attributes = request()->validate([
            'date' => ['required', 'max:255'],
            'time' => ['nullable', 'max:255'],
            ]);

        if ($request->hasFile('partyImg')) {
            $attributes['partyImg'] = $request->file('partyImg')
                ->store('partyImg', 'public');
        }

        $date = $time_attributes['date'];
        $parsed_date = Carbon::parse($date)->format('d F');
        $parsed_time = Carbon::parse($date)->format('H:i');

        $party->update([
            'date' => $parsed_date,
            'time' => $parsed_time,
        ]);
        $party->update($attributes);
        return Redirect::route('party.show');
    }

    public function destroy(Party $party)
    {
        $party->delete();
        return Redirect::route('party.show');
    }



}
