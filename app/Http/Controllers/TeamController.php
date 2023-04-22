<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::orderBy('name')->get();
        return view('teams.index', ['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Team::class);
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Team::class);

        $validated = $request->validate([
            'name'      => 'required|string|unique:teams,name',
            'shortname' => 'required|string|unique:teams,shortname|max:4',
            'image'     => 'nullable|image',
        ],
        [
            'name.required'      => 'Név megadása kötelező!',
            'name.string'        => 'A névnek szövegnek kell lennie!',
            'name.unique'        => 'A névnek egyedinek kell lennie!',
            'shortname.required' => 'Rövid név megadása kötelező!',
            'shortname.string'   => 'A rövid névnek szövegnek kell lennie!',
            'shortname.unique'   => 'A rövid névnek egyedinek kell lennie!',
            'shortname.max'      => 'A maximális hossz 4 karakter!',
            'image.image'        => 'A logónak képnek kell lennie!',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = $file->hashName();
            Storage::disk('public')->put('logos/'. $file_name, $file->get());
            $validated['image'] = $file_name;
        }

        Team::create($validated);

        return to_route('teams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $team->players = $team->players->sortBy('number');
        $team->load('home_games', 'away_games', 'home_games.events', 'home_games.events.player', 'away_games.events', 'away_games.events.player', 'home_games.home_team', 'home_games.away_team', 'away_games.home_team', 'away_games.away_team');
        $team->games = $team->away_games->merge($team->home_games);
        $team->games = $team->games->sortBy('start');
        return view('teams.show', ['t' => $team, 'players_stats' => $team->players_stats]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
