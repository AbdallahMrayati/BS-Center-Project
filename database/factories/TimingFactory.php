<?php

namespace Database\Factories;

use App\Models\Timing;
use App\Models\Course;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimingFactory extends Factory
{
    protected $model = Timing::class;

    public function definition()
    {
        // Randomly select language
        $lang = $this->faker->randomElement(['en', 'ar']);

        // Set Faker locale based on language
        $faker = $lang === 'ar' ? \Faker\Factory::create('ar_SA') : $this->faker;

        // Retrieve a course with the same language
        $course = Course::where('lang', $lang)->inRandomOrder()->first();

        // Retrieve a city with the same language
        $city = City::where('lang', $lang)->inRandomOrder()->first();

        // Ensure we have valid course and city before proceeding
        if (!$course || !$city) {
            throw new \Exception('Make sure to have some courses and cities with the appropriate language created before running the factory.');
        }

        // Generate random date range
        $dateFrom = $this->faker->dateTimeBetween('+1 week', '+1 month');
        $dateTo = (clone $dateFrom)->modify('+' . rand(1, 10) . ' days');

        // Calculate duration
        $duration = (int) $dateFrom->diff($dateTo)->format('%a');

        return [
            'course_id' => $course->id,
            'city_id' => $city->id,
            'title' => $faker->sentence,
            'price' => $faker->randomFloat(2, 100, 1000),
            'date_from' => $dateFrom->format('Y-m-d'),
            'date_to' => $dateTo->format('Y-m-d'),
            'duration' => $duration,
            'lang' => $lang,
            'is_upcoming' => $faker->boolean,
            'is_banner' => $faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
