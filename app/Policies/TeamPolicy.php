<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeamPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $u)
    {
        return $u->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $u, Team $t)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $u, Team $t)
    {
        //
    }
}
