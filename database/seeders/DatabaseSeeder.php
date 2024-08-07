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
        //     'name' => 'Son',
        //     'email' => 'nguyensonvp21@gmail.com',
        //     'password' => '66666666',
        // ]);

        $this->call([
            UserSeeder::class,
            PostsTableSeeder::class,
            TagsTableSeeder::class,
            PostTagsTableSeeder::class,
            PermissionsSeeder::class,
            RolesTableSeeder::class,
        ]);
    }
}
