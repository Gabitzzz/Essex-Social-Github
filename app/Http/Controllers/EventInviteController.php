<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventInviteController extends Controller
{
    public function store(Event $event, $id)
    {

        $eventInvite = new EventInvite();

        $eventInvite->user_id = Auth::user()->id;
        $eventInvite->event_id = $id;

        $eventInvite->save();



        return redirect()->back();
    }


    public function destroy(Party $party,  $id)
    {
        $party->invites()->where('party_id', '=', $id)->where('user_id', Auth::user()->id)->delete();
        return redirect()->back();
    }
}
