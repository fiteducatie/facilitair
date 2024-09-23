<?php

namespace App\Policies;

use App\Models\User;

class BoardPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        // only role admin can view all pins
        return true;
    }

    public function view(User $user, Pin $pin): bool
    {
        // only own pins
        return $user->hasRole('Admin') || $user->id === $pin->user_id;
    }
}
