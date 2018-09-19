<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name'];

    protected $table = 'teams';

    public function myPlayers()
    {
        return $this->hasMany(\App\Player::class);
    }
}
