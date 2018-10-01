<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
          'title' => 'Team 1',
        ])->users()->attach([1,3]);
        Team::create([
          'title' => 'Team 2',
        ])->users()->attach([1,2,3]);
        Team::create([
          'title' => 'Team 3',
        ])->users()->attach([1]);
        Team::create([
          'title' => 'Team 4',
        ])->users()->attach([1,2,3]);
    }
}
