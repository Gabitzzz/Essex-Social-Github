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


    public function index(PartyInvite $party)
    {

//        $par = Party::with('invites','user')
//            ->where("user_id", "=", Auth::id())
//            ->get();


        $par = Party::select('parties.*')
            ->with('invites')
            ->with('user')
            ->latest()->get()->all();

//        $partyInvites = PartyInvite::with('party', 'user')
//            ->where("user_id", "=", Auth::id())
//            ->get();


        $eventInvites = EventInvite::with('event', 'user')
            ->where("user_id", "=", Auth::id())
            ->get();

        $parties = Party::with('invites', 'user')
            ->get();

        $events = Event::with('invites', 'user')
            ->get();

        $myEvents = Party::with('invites')
            ->get();



        return Inertia::render('Dashboard', [
            'parties' => $myEvents,
            'events' => $events,
//            'partyInvites' =>  $myEvents->where('invites.user_id', '=', Auth::id()),
            'partyInvites' => $par,
            'eventInvites' => $eventInvites,


        ]);
    }
}
