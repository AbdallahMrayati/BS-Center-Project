<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        // Define category IDs for English and Arabic
        $englishCategoryIds = [1, 2, 3, 4, 5, 6];
        $arabicCategoryIds = [7, 8, 9];

        // Randomly select language
        $lang = $this->faker->randomElement(['en', 'ar']);

        // Set Faker locale based on language
        $faker = $lang === 'ar' ? \Faker\Factory::create('ar_SA') : $this->faker;

        // Select category ID based on language
        $categoryIds = $lang === 'en' ? $englishCategoryIds : $arabicCategoryIds;

        // Generate slug based on title
        $title = $faker->sentence;
        $slug = Str::slug($title);

        return [
            'category_id' => $faker->randomElement($categoryIds),
            'title' => $title,
            'slug' => $slug,
            'h1' => $faker->sentence,
            'lang' => $lang,
            'overview' => $faker->paragraphs(3, true),
            'description' => $faker->paragraph,
            'objectives' => $faker->paragraphs(3, true),
            'brief' => $faker->paragraph,
            'image_alt' => $faker->words(3, true),
            'image_title' => $faker->words(3, true),
            'meta_title' => $faker->sentence,
            'meta_description' => $faker->paragraph,
            'meta_keywords' => $faker->words(10, true),
            'meta_robots' => 'index,follow',
            'meta_image_size' => '1200x630',
            'meta_type' => 'website',
            'meta_site_name' => $faker->company,
            'meta_site' => $faker->url,
            'meta_local' => $lang === 'ar' ? 'ar_SA' : 'en_US',
            'meta_card' => 'summary_large_image',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
