<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        // Randomly select the language
        $lang = $this->faker->randomElement(['en', 'ar']);

        // Set Faker locale based on language
        $faker = $lang === 'ar' ? \Faker\Factory::create('ar_SA') : $this->faker;

        // Generate slug based on title
        $title = $faker->sentence;
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'h1' => $faker->sentence,
            'lang' => $lang,
            'description' => $faker->paragraphs(3, true),
            'tag_name' => $faker->randomElement(['article', 'blog', 'tag1', 'tag2']),
            'slug' => $slug,
            'number_of_views' => $faker->numberBetween(0, 300),
            'image_alt' => $faker->sentence,
            'image_title' => $faker->sentence,
            'meta_title' => $faker->sentence,
            'meta_description' => $faker->paragraph,
            'meta_keywords' => $faker->words(5, true),
            'meta_robots' => $faker->randomElement(['index,follow', 'noindex,nofollow']),
            'meta_image_size' => $faker->randomElement(['1200x630', '800x600']),
            'meta_type' => $faker->randomElement(['article', 'blog']),
            'meta_site_name' => $faker->company,
            'meta_site' => $faker->url,
            'meta_local' => $lang === 'ar' ? 'ar_SA' : 'en_US',
            'meta_card' => $faker->randomElement(['summary', 'summary_large_image']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
