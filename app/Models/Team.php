<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shortname',
        'image',
    ];

    public function players(){
        return $this->hasMany(Player::class);
    }

    public function games(){
        return $this->hasMany(Game::class, 'home_team_id')->orWhere('away_team_id', $this->id);
        //return $this->hasMany(Game::class);
    }
    public function home_games(){
        return $this->hasMany(Game::class, 'home_team_id');
        //return $this->hasMany(Game::class);
    }
    public function away_games(){
        return $this->hasMany(Game::class, 'away_team_id');
        //return $this->hasMany(Game::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getPlayersStatsAttribute(){
        $games = $this->away_games->merge($this->home_games);
        $players = [];
        foreach ($this->players as $p) {
            $players[strval($p->id)] = ['goal' => 0, 'own_goal' => 0, 'yellow_card' => 0, 'red_card' => 0];
        }
        foreach ($games as $g) {
            foreach ($g->events as $e) {
                if(in_array($e->player->id, $this->players->map(fn ($e) => $e->id)->toArray())){
                    if($e->type == 'goal') $players[strval($e->player->id)]['goal']++;
                    else if($e->type == 'own_goal') $players[strval($e->player->id)]['own_goal']++;
                    else if($e->type == 'yellow_card') $players[strval($e->player->id)]['yellow_card']++;
                    else if($e->type == 'red_card') $players[strval($e->player->id)]['red_card']++;
                }
            }
        }
        return $players;
    }

    public function getPointsAttribute(){
        $points = 0;
        foreach ($this->home_games as $g) {
            $result = $g->results;
            if($result['home_team'] > $result['away_team']){
                $points += 3;
            }
            else if($result['home_team'] === $result['away_team']){
                $points += 1;
            }
        }
        foreach ($this->away_games as $g) {
            $result = $g->results;
            if($result['home_team'] < $result['away_team']){
                $points += 3;
            }
            else if($result['home_team'] === $result['away_team']){
                $points += 1;
            }
        }
        return $points;
    }

    public function getGoalDifferenceAttribute(){
        $goal_difference = 0;
        foreach ($this->home_games as $g) {
            $result = $g->results;
            $goal_difference += $result['home_team'] - $result['away_team'];
        }
        foreach ($this->away_games as $g) {
            $result = $g->results;
            $goal_difference += $result['away_team'] - $result['home_team'];
        }
        return $goal_difference;
    }
}
