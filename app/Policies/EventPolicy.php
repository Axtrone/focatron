<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Game;
use App\Models\Event;

class EventPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user, Game $game) {
        return $user->is_admin && $game->start < now() && !$game->finished;
    }

    public function delete(User $user, Event $event, Game $game){
        return $user->is_admin && $game->start < now() && !$game->finished;
    }
}
