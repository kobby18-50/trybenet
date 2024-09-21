<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            'email' => 'kobby@mail.com',
            'name' => 'Edward Kobby',
            'password' => Hash::make('password'),
            'is_admin' => true 
            ],

            [
            'email' => 'adama@mail.com',
            'name' => 'Adama Ben',
            'password' => Hash::make('password'),
            'is_admin' => false 
            ],


        ]);
    }
}
