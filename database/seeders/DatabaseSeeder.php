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
        // Generate users
        $users = collect();
        $users->add(User::factory()->create([
            'email' => 'admin@szerveroldali.hu',
            'password' => Hash::make("admin")
        ]));
        for($i = 1; $i <= 20; $i++){
            $users -> add(User::factory()->create([
                'email' => 'user' . $i . '@szerveroldali.hu',
            ]));
        }

        // Generate teams and players
        $teams = collect();
        $players = collect();
        for($i=0; $i < 10; $i++) {
            $team = Team::factory()->create();
            for ($j=0; $j < 11; $j++) {
                $players->add(Player::factory()->create([
                    'team_id' => $team->id,
                ]));
            }
            $teams->add($team);
        }

        // Generate games and events
        for ($i=0; $i < 30; $i++) {
            do {
                $team1 = $teams->random();
                $team2 = $teams->random();
            } while ($team1 == $team2);

            $game = Game::factory()->create([
                'home_team_id' => $team1->id,
                'away_team_id' => $team2->id
            ]);
            $players = collect();
            for ($j=0; $j < 11; $j++) {
                $players->add($team1->players[$j]);
                $players->add($team2->players[$j]);
            }
            for ($j=0; $j < rand(3, 15); $j++) {
                Event::factory()->create([
                    'player_id' => $players->random()->id,
                    'game_id' => $game->id
                ]);
            }
        }
    }
}
