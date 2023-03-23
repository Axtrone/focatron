<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Event;
use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        define('TEAM_COUNT',12);
        define('USER_COUNT',20);
        define('PLAYER_COUNT',11);
        define('GAME_COUNT', 30);

        // Generate users
        $users = collect();
        $users->add(User::factory()->create([
            'email' => 'admin@szerveroldali.hu',
            'password' => Hash::make("admin")
        ]));
        for($i = 1; $i <= USER_COUNT; $i++){
            $users -> add(User::factory()->create([
                'email' => 'user' . $i . '@szerveroldali.hu',
            ]));
        }

        // Generate teams and players
        $teams = collect();
        for($i=0; $i < TEAM_COUNT; $i++) {
            $team = Team::factory()->create();
            for ($j=0; $j < PLAYER_COUNT; $j++) {
                Player::factory()->create([
                    'team_id' => $team->id,
                ]);
            }
            $teams->add($team);
        }

        // Generate games and events
        for ($i=0; $i < GAME_COUNT; $i++) {
            $t = $teams->random(2);

            $game = Game::factory()->create([
                'home_team_id' => $t[0]->id,
                'away_team_id' => $t[1]->id
            ]);
            $players = collect($t[0]->players->merge($t[1]->players));
            for ($j=0; $j < rand(1, 15); $j++) {
                Event::factory()->create([
                    'player_id' => $players->random()->id,
                    'game_id' => $game->id
                ]);
            }
        }

        //Generate favourites
        foreach ($users as $u) {
            $u->teams()->attach($teams->random(rand(1,9))->map(function($e){
                return $e->id;
            }));
        }
    }
}
