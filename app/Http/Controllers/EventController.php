<?php
namespace App\Http\Controllers;

use App\Events\SomeonePostedEvent;
use App\Http\Requests\StoreImage;
use App\Models\Event;
use App\Models\Party;
use App\Models\PartyInvite;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::select('events.*')
            ->with('invites')
            ->with('user')
            ->latest()->get()->all();

        return Inertia::render('Event/Events', [
            'events' => $events,
        ]);


    }

    public function display(Event $event, User $user)
    {
        $var = $event::with('invites')->where("id", "=", $event->id)->with('user')->get()->first();

        return Inertia::render('Event/Index', [
            'event' => $var,
            'inviteToggle' => $event->invites()->where('event_invites.user_id', auth()->id())->exists(),
        ]);
    }

    public function create(User $user)
    {
        $followers = User::orderBy('id', 'desc')
            ->paginate(5);

        return Inertia::render('Event/Create', [
            'user' => $user,
            'followers' => $followers
        ]);
    }

    public function store(StoreImage $request)
    {
        $attributes = request()->validate([
            'description' => 'required|max:255',
            'title' => 'required|max:255',
            'date' => 'required|max:255',
            'location' => 'required|max:255',
            'time' => 'nullable|max:255',
            'eventImg' => 'nullable|image',
            'user_id' => ['nullable', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('user_id', Auth::user()->id);
            })],
        ]);

//        DATE PARSE
        $date = $attributes['date'];
        $parsed_date = Carbon::parse($date)->format('d F');
        $parsed_time = Carbon::parse($date)->format('H:i');

        $image_path = '';
        if ($request->hasFile('eventImg')) {
            $image_path = $request->file('eventImg')->store('event', 'public');
        }

        {
            Event::create([
                'user_id' => auth()->id(),
                'title' => $attributes['title'],
                'description' => $attributes['description'],
                'location' => $attributes['location'],
                'date' => $parsed_date,
                'time' => $parsed_time,
                'eventImg' => $image_path,
//            'image'=> $imagePath,
            ]);
            $user = User::where('id', auth()->id())->first();
//        $user->notify(new SomeonePosted($user, auth()->user()));
            event(new SomeonePostedEvent($user, auth()->user()));
            return Redirect::route('event.show');
        }
    }

    public function edit(Event $event)
    {
        return Inertia::render('Event/Edit', [
            'event' => Event::with('user')->where("id", "=", $event->id)->get()->first(),
        ]);
    }

    public function update(Event $event, StoreImage $request)
    {
        $attributes = request()->validate([
            'title' => ['string', 'max:255'],
            'description' => ['string', 'max:255'],
            'location' => ['string', 'max:255'],
            'eventImg' => ['nullable', 'file'],
        ]);
        $time_attributes = request()->validate([
            'date' => ['required', 'max:255'],
            'time' => ['nullable', 'max:255'],
        ]);

        if ($request->hasFile('eventImg')) {
            $attributes['eventImg'] = $request->file('eventImg')
                ->store('eventImg', 'public');
        }

        $date = $time_attributes['date'];
        $parsed_date = Carbon::parse($date)->format('d F');
        $parsed_time = Carbon::parse($date)->format('H:i');

        $event->update([
            'date' => $parsed_date,
            'time' => $parsed_time,
        ]);
        $event->update($attributes);
        return Redirect::route('event.show');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return Redirect::route('event.show');
    }


}
