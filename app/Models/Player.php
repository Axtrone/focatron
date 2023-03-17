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
    ];

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
