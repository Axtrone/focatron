<?php

namespace App\Policies;

use App\Models\Player;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlayerPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $u)
    {
        return $u->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $u, $player_stat)
    {
        $event_count = 0;
        foreach ($player_stat as $e) {
            $event_count += $e;
        }
        return $u->is_admin && $event_count == 0;
    }
}
