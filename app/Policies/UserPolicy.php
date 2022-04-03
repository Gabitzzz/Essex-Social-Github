<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
       return $user->email === 'john@doe.com';

    }

    public function edit(User $user)
    {
        return $user->email === 'nl19102@essex.ac.uk';

    }
}
