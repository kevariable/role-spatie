<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTestingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Another user with roles and permission testing

        User::create([
            'name' => 'Supry',
            'email' => 'supry@gmail.com',
            'password' => bcrypt('eBwtcGhYrX9BKWp')
        ])->assignRole('writer');

        User::create([
            'name' => 'Joni',
            'email' => 'joni@gmail.com',
            'password' => bcrypt('eBwtcGhYrX9BKWp')
        ])->assignRole('editor');

        User::create([
            'name' => 'Jordi',
            'email' => 'jordy@gmail.com',
            'password' => bcrypt('eBwtcGhYrX9BKWp')
        ])->assignRole('publisher');
    }
}
