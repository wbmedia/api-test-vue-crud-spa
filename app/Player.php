<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['first_name', 'last_name', 'team_id'];

    protected $table = 'players';

    public function playerTeams()
    {
        return $this->belongsTo(\App\Team::class);
    }
}
