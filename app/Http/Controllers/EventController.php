<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Game;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

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

        return to_route('games.show', ['game' => $validated['game_id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Request $request)
    {
        $this->authorize('delete', [Event::class, $event, Game::find($request['game_id'])]);
        $event->delete();
        return to_route('games.show', ['game' => $request['game_id']]);
    }
}
