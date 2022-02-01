<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyInviteController extends Controller
{
    public function index(Party $party)
    {

        return Inertia::render('Follow/Following', [
            'inviteToggle' => $party->invites()->where('user_id', auth()->id())->exists(),

            'invites' => $party->invites()->withCount([
                'invites as party_invites' => function($q) {
                    return $q->where('party_id', 'party.id');
                }
            ])->withCasts(['party_invites' => 'boolean'])
                ->paginate(),
            'profile' => [
                'user' => $party
            ]
        ]);
    }


    public function store(Party $party, $id)
    {
        $party->invites()->attach($id);
        return redirect()->back();
    }

    public function destroy(Party $party, $id)
    {
        $party->invites()->detach($id);
        return redirect()->back();
    }

}
