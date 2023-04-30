<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'start',
        'finished',
        'home_team_id',
        'away_team_id'
    ];

    use HasFactory;

    public function home_team(){
        return $this->belongsTo(Team::class, 'home_team_id');
    }
    public function away_team(){
        return $this->belongsTo(Team::class, 'away_team_id');
    }
    public function events(){
        return $this->hasMany(Event::class);
    }

    public function getResultsAttribute(){
        $res = ["home_team" => 0, 'away_team' => 0];

        foreach ($this->events as $e) {
            if($e->type == 'goal'){
                if($e->player->team->id == $this->home_team->id){
                    $res['home_team']++;
                }
                else{
                    $res['away_team']++;
                }
            }
            else if($e->type == 'own_goal'){
                if($e->player->team->id == $this->home_team->id){
                    $res['away_team']++;
                }
                else{
                    $res['home_team']++;
                }
            }
        }

        return $res;
    }
}
