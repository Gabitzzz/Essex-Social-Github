<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\User;
use Inertia\Inertia;

class DegreeController extends Controller
{
    //

    public function index(Degree $degree)
    {

        $users = User::where('degree', '=', $degree->id)->get()->all();


        return Inertia::render('Degree/Index', [
            'degree' => $degree,
            'users' => $users,
        ]);
    }
}
