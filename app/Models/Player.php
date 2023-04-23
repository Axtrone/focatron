<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'birthdate',
        'team_id'
    ];

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function getGoalsAttribute(){
        $ret = 0;
        foreach ($this->team->games as $g) {
            foreach ($g->events as $e) {
                if($e->type == 'goal' && $e->player->id == $this->id){
                    $ret++;
                }
            }
        }
        return $ret;
    }

    public function getStatsAttribute(){
        $stats = ['goal' => 0, 'own_goal' => 0, 'yellow_card' => 0, 'red_card' => 0];
        foreach ($this->team->games as $g) {
            foreach ($g->events as $e) {
                if($e->player->id == $this->id){
                    if($e->type == 'goal') $stats['goal']++;
                    else if($e->type == 'own_goal') $stats['own_goal']++;
                    else if($e->type == 'yellow_card') $stats['yellow_card']++;
                    else if($e->type == 'red_card') $stats['red_card']++;
                }
            }
        }
        return $stats;
    }
}
