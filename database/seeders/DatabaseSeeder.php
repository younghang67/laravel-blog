<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Create other roles if needed
        User::factory()->create([
            'name' => 'Rusan',
            'email' => 'editor@example.com',
            'role' => 'author',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
        ]);

        $this->call([
            CategorySeeder::class,
            BlogPostSeeder::class
        ]);
    }
}
