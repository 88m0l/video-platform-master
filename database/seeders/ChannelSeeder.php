<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "hsoub-academy",
            'email' => 'academy-hsoub@gmail.com',
            'password' => bcrypt('11111111'),
            'current_team_id' => '1',
            'user_type' => 'super_admin',
        ]);

        User::create([
            'name' => "hsoub",
            'email' => 'hsoub@gmail.com',
            'password' => bcrypt('11111111'),
            'current_team_id' => '2',
            'user_type' => 'user',
        ]);

        User::create([
            'name' => "Mostaql",
            'email' => 'mostaql@gmail.com',
            'password' => bcrypt('11111111'),
            'current_team_id' => '3',
            'user_type' => 'user',
        ]);

        User::create([
            'name' => "Baeed",
            'email' => 'baeed@gmail.com',
            'password' => bcrypt('11111111'),
            'current_team_id' => '4',
            'user_type' => 'user',
        ]);

        User::create([
            'name' => "Khamsat",
            'email' => 'khamsat@gmail.com',
            'password' => bcrypt('11111111'),
            'current_team_id' => '5',
            'user_type' => 'user',
        ]);

        User::create([
            'name' => "Ana",
            'email' => 'ana@gmail.com',
            'password' => bcrypt('11111111'),
            'current_team_id' => '6',
            'user_type' => 'user',
        ]);
    }
}
