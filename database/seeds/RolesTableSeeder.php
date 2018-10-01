<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
          'name' => 'admin',
          'description' => 'Admin can do everything; CRUD Users, Teams and Roles',
        ]);

        DB::table('roles')->insert([
          'name' => 'manager',
          'description' => 'Manager can only update his own profile',
        ]);

        DB::table('roles')->insert([
          'name' => 'member',
          'description' => 'Member can only view everything',
        ]);
    }
}
