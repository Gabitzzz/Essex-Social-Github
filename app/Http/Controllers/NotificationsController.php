<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;


class NotificationsController extends Controller
{
    public function index()
    {
        return Inertia::render('Notifications/Index');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(Request $request, $id)
    {
        $notification = auth()->user()->unreadNotifications->find($id);
        $notification->markAsRead();

        return Redirect::route('notifications.show', [
            'notification' => $notification
        ] );
    }

    public function update(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications;
        $notifications->markAsRead();
        return back();
    }
}
