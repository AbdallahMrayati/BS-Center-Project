<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Course;
use App\Models\Timing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            CategorySeeder::class,
            CitiesTableSeeder::class,
            MetaSeeder::class
        ]);

        Blog::factory()->count(10)->create();
        Course::factory()->count(10)->create();
        Timing::factory()->count(50)->create();
    }
}
