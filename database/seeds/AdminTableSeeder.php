<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Kevin Abrar Khansa',
            'email' => 'kevariable@gmail.com',
            'password' => bcrypt('eBwtcGhYrX9BKWp')
        ]);

        $user->assignRole('admin');
    }
}
