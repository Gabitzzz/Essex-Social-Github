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
       return $user->email === 'robert.joitoiu@stud.etti.upb.ro';
    }

    public function edit(User $user)
    {
        return $user->email === 'robert.joitoiu@stud.etti.upb.ro';

    }
}
