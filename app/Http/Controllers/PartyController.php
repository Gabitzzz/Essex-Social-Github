<?php

namespace App\Http\Controllers;

use App\Events\SomeonePostedEvent;
use App\Http\Requests\StoreImage;
use App\Models\Party;
use App\Models\PartyComment;
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
        $parties = Party::select('parties.*')
            ->with('invites')
            ->with('user')
            ->latest()->get()->all();

        return Inertia::render('Party/Parties', [
            'parties' => $parties,
            'invites' => PartyInvite::all(),
        ]);
    }

    public function display(Party $party, User $user)
    {
        $var = $party::with('invites')->where("id", "=", $party->id)->with('user')->get()->first();
        $invites = PartyInvite::with('user')->where("party_id", "=", $party->id)->get();

        return Inertia::render('Party/Index', [
            'party' => $var,
            'inviteToggle' => $party->invites()->where('party_invites.user_id', auth()->id())->exists(),
            'invites' => $invites,
            'comments' => PartyComment::with('party')->where("party_id", "=", $party->id)->with('user')->latest()->get(),
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
        //        VALIDATION
        $attributes = request()->validate([
            'description' => 'required|max:255',
            'title' => 'required|max:255',
            'date' => 'required|max:255',
            'location' => 'required|max:255',
            'time' => 'nullable|max:255',
            'day' => 'nullable|max:255',
            'partyImg' => 'nullable|image',
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
        ]);

//        DATE PARSE
        $date = $attributes['date'];
        $add = Carbon::parse($date)->addHours(3);

        $parsed_day = Carbon::parse($add)->format('d F');
        $parsed_time = Carbon::parse($add)->format('H:i');

        $image_path = '';
        if ($request->hasFile('partyImg')) {
            $image_path = $request->file('partyImg')->store('party', 'public');
        }

//        CREATING
        Party::create([
            'user_id' => auth()->id(),
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'location' => $attributes['location'],
            'date' => $attributes['date'],
            'day' => $parsed_day,
            'time' => $parsed_time,
            'partyImg' => $image_path,
//            'image'=> $imagePath,
        ]);
        $user = User::where('id', auth()->id())->first();
//        $user->notify(new SomeonePosted($user, auth()->user()));
        event(new SomeonePostedEvent($user, auth()->user()));
        return Redirect::route('party.show');
    }

    public function edit(Party $party)
    {
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
            'date' => ['required', 'max:255'],
            'partyImg' => ['nullable', 'file'],
        ]);
        $time_attributes = request()->validate([
            'time' => ['nullable', 'max:255'],
            'day' => ['nullable', 'max:255'],
        ]);

        if ($request->hasFile('partyImg')) {
            $attributes['partyImg'] = $request->file('partyImg')
                ->store('partyImg', 'public');
        }

        $day = $attributes['date'];
        $time = $attributes['date'];

        $parsed_day = Carbon::parse($day)->format('d F');
        $parsed_time = Carbon::parse($time)->format('H:i');

        $party->update([
            'day' => $parsed_day,
            'time' => $parsed_time,
        ]);
        $party->update($attributes);
        return Redirect::route('party.show');
    }

    public function destroy(Party $party)
    {
        $party::where('date', '<', Carbon::now())->delete();

        $party->delete();
        return Redirect::route('party.show');
    }

    public function members(Party $party)
    {
        $invites = PartyInvite::with('user')->where("party_id", "=", $party->id)->get();

        return Inertia::render('Party/Members', [
            'party' => $party,
            'inviteToggle' => $party->invites()->where('party_invites.user_id', auth()->id())->exists(),
            'invites' => $invites,
        ]);
    }


}
