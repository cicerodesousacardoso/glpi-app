<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function admin(User $user): bool
    {
        return $user->role_id == 1;
    }

    public function tecnico(User $user): bool
    {
        return $user->role_id == 2;
    }
}
