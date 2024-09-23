<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\City;
use App\Models\Course;
use App\Models\Timing;
use Illuminate\Support\Facades\Log;

class ImportData
{
    private $categories;
    private $courses;
    private $cities;

    public function __construct()
    {
        Log::info("From ImportData construct");
        $this->categories = Category::all(['id', 'title']);
        $this->courses = Course::all(['id', 'title']);
        $this->cities = City::all(['id', 'title']);
    }

    public function model(array $row)
    {
        Log::info("From ImportData model");
        if ($row[0] == 'title') {
            return null;
        }
        Log::info("Processing row:", $row);

        $startFormatted = $row[5];
        $endFormatted = $row[6] ? $row[6] : null;

        // Process the rest of the row
        $category = $this->categories->where('title', $row[2])->first();

        if (!$category) {
            $category = Category::create([
                'lang' => $row[7],
                'title' => $row[2],
                'h1' => $row[2],
                'slug' => $this->customSlug($row[2]),
            ]);

            $this->categories->push($category);
            Log::info("Category created:", ["category" => $category]);
        }

        $course = $this->courses->where('title', $row[0])->first();
        if (!$course) {
            $course = Course::create([
                'category_id' => $category->id,
                'lang' => $row[7],
                'title' => $row[0],
                'h1' => $row[0],
                'slug' => $this->customSlug($row[0]),
            ]);

            $this->courses->push($course);
            Log::info("Course created:", ["course" => $course]);
        }

        $city = $this->cities->where('title', $row[4])->first();
        if (!$city) {
            $city = City::create([
                'title' => $row[4],
                'h1' => $row[4],
                'lang' => $row[7],
                'slug' => $this->customSlug($row[4]),
            ]);

            $this->cities->push($city);
            Log::info("City created:", ["city" => $city]);
        }

        // Create the timing
        $timing = Timing::create([
            'course_id' => $course->id,
            'lang' => $row[7],
            'city_id' => $city->id,
            'price' => $row[3],
            'title' => $course->title,
            'date_from' => $startFormatted,
            'date_to' => $endFormatted,
            'duration' => $row[1],
        ]);

        Log::info("Time created:", ["timing" => $timing]);
        $timing->save();
        return $timing;
    }
    // private function convertExcelDate($dateString)
    // {
    //     return date('Y-m-d', strtotime($dateString));  // Convert the date string to 'Y-m-d' format
    // }

private function customSlug($string = null, $separator = "-")
{
    if (is_null($string)) {
        return "";
    }

    $string = trim($string);
    $string = mb_strtolower($string, "UTF-8");

    $string = str_replace(['&', '@', '#', '$', '%'], '', $string);

    $string = str_replace('/', $separator, $string);
    $string = str_replace('\\', $separator, $string);

    $string = preg_replace('/\s+/', $separator, $string);

    $string = preg_replace('/[^\w\x{0621}-\x{064A}0-9' . preg_quote($separator) . ']+/u', '', $string);

    return $string;
}


    public function chunkSize(): int
    {
        return 100;
    }
}

