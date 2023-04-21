<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
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
        $this -> authorize('create', Game::class);

        $teams = Team::get();
        return view('games.create', ['teams' => $teams]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> authorize('create', Game::class);

        $validated = $request->validate([
            'home_team_id'  => 'required|integer|exists:teams,id|different:away_team_id',
            'away_team_id'  => 'required|integer|exists:teams,id|different:home_team_id',
            'start'         => 'required|date|after:now',
        ],
        [
            'away_team_id.different' => 'A két csapat nem egyezhet meg!',
            'home_team_id.different' => 'A két csapat nem egyezhet meg!',
            'start.after'            => 'A dátumnak a jovőben kell lennie!'
        ]);

        $validated['finished'] = false;

        Game::create($validated);

        return to_route('games.index');
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

        $game->home_team->players = array_values(Arr::sort($game->home_team->players, function ($value) {
            return $value->number;
        }));
        $game->away_team->players = array_values(Arr::sort($game->away_team->players, function ($value) {
            return $value->number;
        }));

        return view('games.show', ['g' => $game]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        $this -> authorize('edit', Game::class);

        $teams = Team::get();
        return view('games.edit', ['teams' => $teams, 'g' => $game]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $this -> authorize('edit', Game::class);

        $validated = $request->validate([
            'home_team_id'  => 'required|integer|exists:teams,id|different:away_team_id',
            'away_team_id'  => 'required|integer|exists:teams,id|different:home_team_id',
            'start'         => 'required|date',
        ],
        [
            'away_team_id.different' => 'A két csapat nem egyezhet meg!',
            'home_team_id.different' => 'A két csapat nem egyezhet meg!'
        ]);


        $game->update($validated);

        return to_route('games.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $this->authorize('delete', Game::class);
        $game->delete();
        return to_route('games.index');
    }

    public function close(Game $game){
        $this->authorize('create', Game::class);
        $game->finished = true;
        $game->save();
        return to_route('games.show', ['game' => $game]);
    }
}
