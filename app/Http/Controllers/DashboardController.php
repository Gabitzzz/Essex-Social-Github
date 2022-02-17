<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\PartyInvite;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Party $party)
    {

        $parties = Party::all();

        $partyInvites = PartyInvite::with('party', 'user')->where("user_id", "=", Auth::id())->get();



//        $my_party = $parties->where('invites.id','=', Auth::id())->get();
        return Inertia::render('Dashboard', [
            'parties' =>$parties,
            'invites' => $partyInvites,

        ]);
    }
}
