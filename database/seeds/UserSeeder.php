<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'moataz alsahbu',
            'email' => 'moataz.alsahbu@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
