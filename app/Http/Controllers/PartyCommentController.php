<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class PartyCommentController extends Controller
{
    //
    public function index()
    {
        //
    }

    public function store(Party $party)
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
            'party_id' => 'nullable',
        ]);

        auth()->user()->partyComments()->create([
            'user_id' => auth()->id(),
            'party_id' => $party->id,
            'body' => $attributes['body'],

        ]);
        return Redirect::route('party.item', $party->id)->with('success', 'Comment posted.');
    }
}
