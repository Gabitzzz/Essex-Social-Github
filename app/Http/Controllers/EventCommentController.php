<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;


class EventCommentController extends Controller
{
    //

    public function store(Event $event)
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
            'event_id' => 'nullable',
        ]);

        auth()->user()->eventComments()->create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'body' => $attributes['body'],

        ]);
        return Redirect::route('event.item', $event->id)->with('success', 'Comment posted.');
    }
}
