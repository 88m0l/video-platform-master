<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alert;
use App\Models\User;

class AlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alert::create([
            'user_id' => User::where('name', 'hsoub-academy')->first()->id,
            'alert' => '0',
        ]);

        Alert::create([
            'user_id' => User::where('name', 'hsoub')->first()->id,
            'alert' => '0',
        ]);

        Alert::create([
            'user_id' => User::where('name', 'Mostaql')->first()->id,
            'alert' => '0',
        ]);

        Alert::create([
            'user_id' => User::where('name', 'Baeed')->first()->id,
            'alert' => '0',
        ]);

        Alert::create([
            'user_id' => User::where('name', 'Khamsat')->first()->id,
            'alert' => '0',
        ]);

        Alert::create([
            'user_id' => User::where('name', 'Ana')->first()->id,
            'alert' => '0',
        ]);
    }
}
