<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Event;
use App\Models\Party;
use App\Models\Post;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {

        $degrees = Degree::all();
        return Inertia::render('Auth/Register', [
            'degrees' => $degrees,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $parsed_day =
        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:16|unique:users',
            'email' => 'required|string|email|max:40|regex:/(.*)@stud.etti.upb\.ro/i|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dob' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'study_year' => 'nullable|string|max:50',
            'degree' => 'nullable|max:30',
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
//            'dob' => $request->dob,
            'dob' => Carbon::parse($request->dob)->format('d F Y'),
            'type' => $request->type,
            'study_year' => $request->study_year,
            'degree' => $request->degree,
        ]);
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
