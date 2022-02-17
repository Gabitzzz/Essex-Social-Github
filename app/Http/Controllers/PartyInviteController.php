<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\PartyInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartyInviteController extends Controller
{
    public function store(Party $party, $id)
    {

        $partyInvite = new PartyInvite();

        $partyInvite->user_id = Auth::user()->id;
        $partyInvite->party_id = $id;

        $partyInvite->save();



        return redirect()->back();
    }


    public function destroy(Party $party,  $id)
    {
        $party->invites()->where('party_id', '=', $id)->where('user_id', Auth::user()->id)->delete();
        return redirect()->back();
    }

}
