<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Game;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', [Event::class, Game::find($request['game_id'])]);

        $validated = $request->validate([
            'minute'    => 'required|integer|min:0|max:90',
            'type'      => 'required|in:goal,own_goal,red_card,yellow_card',
            'player_id' => 'required|exists:players,id|integer',
            'game_id'   => 'required|exists:games,id|integer'
        ],
        [
            'minute.required' => 'A perc megadása kötelező!'
        ]);

        Event::create($validated);

        Session::flash('event-created');

        return to_route('games.show', ['game' => $validated['game_id']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Request $request)
    {
        $this->authorize('delete', [Event::class, $event, Game::find($request['game_id'])]);
        $event->delete();
        Session::flash('event-deleted');
        return to_route('games.show', ['game' => $request['game_id']]);
    }
}
