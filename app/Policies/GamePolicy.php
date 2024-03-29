<?php

namespace App\Policies;

use App\Models\User;

class GamePolicy
{
    public function create(User $u) {
        return $u->is_admin;
    }

    public function delete(User $u){
        return $u->is_admin;
    }

    public function update(User $u){
        return $u->is_admin;
    }
}
