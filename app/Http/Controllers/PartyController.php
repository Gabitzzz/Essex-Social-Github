<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PartyController extends Controller
{
    public function create()
    {
        return Inertia::render('Party/Create');
    }
}
