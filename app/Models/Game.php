<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'start',
        'finished',
    ];

    use HasFactory;

    public function home_team(){
        return $this->belongsTo(Team::class);
    }
    public function away_team(){
        return $this->belongsTo(Team::class);
    }
    public function events(){
        return $this->hasMany(Event::class);
    }
}
