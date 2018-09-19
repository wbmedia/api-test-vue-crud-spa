<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = factory(\App\Team::class, 5)->create();
        $teams->each(function ($e_team){
            $team_players = factory(\App\Player::class,10)->make();
            $e_team->myPlayers()->saveMany($team_players);
        });

    }
}
