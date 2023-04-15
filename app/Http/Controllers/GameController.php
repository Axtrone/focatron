<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $live_games = Game::where([['start', '<=',  now()], ['finished', false]])->get();
        $games = Game::with(['home_team', 'away_team', 'events.player.team'])->orderBy('start')->get()->diff($live_games);

        if($request->get('p') == null) $page = ceil($games->search(fn($p) => $p->finished == false) / 10);
        else $page = $request->get('p');

        $paginated = new LengthAwarePaginator(
            $games->forPage($page, 10),
            $games->count(),
            10,
            $page,
            ['path' => route('games.index'), 'pageName' => 'p'],
        );

        return view('games.index', ['games' => $paginated, 'live_games' => $live_games]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        $game->load('events', 'events.player', 'events.player.team');
        $game->events = array_values(Arr::sort($game->events, function ($value) {
            return $value->minute;
        }));
        return view('games.show', ['g' => $game]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
