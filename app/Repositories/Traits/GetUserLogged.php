<?php

namespace App\Repositories\Traits;

use App\Models\User;

trait GetUserLogged
{
    private function getUser(): User
    {
        return auth()->user();
    }
}
