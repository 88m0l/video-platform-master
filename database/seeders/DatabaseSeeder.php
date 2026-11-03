<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(ChannelSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(ConvertedVideoSeeder::class);
        $this->call(ViewSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(LikeSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(AlertSeeder::class);
    }
}
