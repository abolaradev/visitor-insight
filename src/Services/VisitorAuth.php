<?php

namespace Abolaradev\Visitor\Services;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class VisitorAuth
{
    /**
     * Retrieve the currently authenticated user.
     *
     * @return User|null The authenticated user, or null if no user is authenticated.
     */
    public static function user(): ?User
    {
        return Auth::user();
    }
}