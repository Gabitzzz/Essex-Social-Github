<?php

namespace App\Http\Controllers;

use App\Events\SomeonePostedEvent;
use App\Http\Requests\StoreImage;
use App\Models\Party;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PartyController extends Controller
{

    public function index(Party $party, User $user)
    {


        $parties = Party::select('parties.*')->latest()->get()->all();

        return Inertia::render('Party/Parties', [

            'parties' => $parties,
            'invites' => $party->invites()->withCount([
                'invites as party_invites' => function ($q) {
                    return $q->where('party_id', 'id');
                }
            ])->withCasts(['party_invites' => 'boolean'])->paginate(),


        ]);


    }

    public function display(Party $party, User $user)
    {
        return Inertia::render('Party/Index', [
            'party' => $party,
            'inviteToggle' => $party->where('user_id', auth()->id())->exists(),


//            'followers' => $user->followers()->withCount([
//                'followers as following' => function ($q) {
//                    return $q->where('follower_id', auth()->id());
//                }
//            ])->withCasts(['following' => 'boolean'])
//                ->paginate(),
//            'profile' => [
//                'user' => $user
//            ],


            'invites' => $party->invites()->withCount([
                'invites as party_invites' => function ($q) {
                    return $q->where('party_id', 'party');
                }
            ])->withCasts(['party_invites' => 'boolean'])->paginate(),


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
                'body' => $attributes['body'],
                'date' => $parsed_date,
                'time' => $parsed_time,
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
