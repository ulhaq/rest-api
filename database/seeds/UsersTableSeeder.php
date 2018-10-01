<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'name' => 'Administrator',
          'email' => 'admin@api.com',
          'password' => bcrypt('12345678'),
        ])->roles()->attach([1]);

        User::create([
          'name' => 'Manager',
          'email' => 'manager@api.com',
          'password' => bcrypt('12345678'),
        ])->roles()->attach([2]);

        User::create([
          'name' => 'Member',
          'email' => 'member@api.com',
          'password' => bcrypt('12345678'),
        ])->roles()->attach([3]);
    }
}
