<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlayerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Player::class);

        $validated = $request->validate([
            'name'      => 'required|string',
            'number'    => 'required|integer|min:0',
            'birthdate' => 'required|date|before:now',
            'team_id'   => 'required|integer|exists:teams,id'
        ],
        [
            'name.required'     => 'Név megadása kötelező!',
            'name.string'       => 'A névnek szövegnek kell lennie!',
            'number.required'   => 'Mezszám megadása kötelező',
            'number.min'        => 'A mezszám nem lehet negatív!',
            'birthdate.required'=> 'A születési dátum megadása kötelező!',
            'birthdate.before'  => 'A születési dátum nem lehet a jövőben!'
        ]);

        Player::create($validated);

        Session::flash('player-created');

        return to_route('teams.show', ['team' => $validated['team_id']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        $this->authorize('delete', [Player::class, $player->team->players_stats[strval($player->id)]]);

        $player->delete();

        Session::flash('player-deleted');

        return to_route('teams.show', ['team' => $player->team]);
    }
}
