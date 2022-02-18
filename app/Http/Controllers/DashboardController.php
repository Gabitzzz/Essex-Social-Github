<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventInvite;
use App\Models\Party;
use App\Models\PartyInvite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{


    public function index(Party $party, User $user)
    {

        $partyInvites = PartyInvite::all();


        $parties = Party::with('invites')

            ->join('party_invites', 'parties.id','=','party_invites.party_id')
            ->join('users', 'parties.user_id','=','users.id')
            ->where('party_invites.user_id','=', Auth::id())
            ->select('parties.*',  'users.username')
            ->get();








        $eventInvites = EventInvite::with('event', 'user')
            ->where("user_id", "=", Auth::id())
            ->get();


        $events = Event::with('invites', 'user')
            ->get();


//        $var = $party::with('invites')->where("id", "=", $party->id)->with('user')->get()->first();


        return Inertia::render('Dashboard', [
            'parties' => $parties,
            'events' => $events,
            'partyInvites' => $partyInvites,
            'eventInvites' => $eventInvites,


        ]);
    }
}
