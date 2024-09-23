<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Course;
use App\Models\Timing;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index(Request $request)
    {
        $currentLocale = app()->getLocale(); // Get the current language

        // Start with the Timing model and apply filters
        $query = Timing::where('lang', $currentLocale)->where('hidden', false);
        $query = $this->courseService->applySearchFilters($request, $query);

        // Get the filtered timings with related course and city data
        $timings = $query->with(['course', 'city'])
            ->get(['course_id', 'city_id', 'date_from', 'date_to'])
            ->map(function ($timing) {
                return [
                    'course_title' => $timing->course->title,
                    'course_image' => $timing->course->getFirstMediaUrl('images'), // Adjust the media collection name if needed
                    'date_from' => $timing->date_from,
                    'date_to' => $timing->date_to,
                    'city_title' => $timing->city->title,
                ];
            });

        // Fetch filtered cities
        $cities = City::where('lang', $currentLocale)
            ->where('hidden', false)
            ->get();
        // Fetch durations
        $durations = Timing::select('duration')->distinct()->pluck('duration');

        // Fetch filtered categories
        $categories = Category::where('lang', $currentLocale)
            ->where('hidden', false)
            ->get();

        $cities = City::where('lang', $currentLocale)
            ->where('hidden', false)
            ->with('media')->get(); // Fetch cities with their media

        return view('screen.venus', compact('timings', 'cities', 'categories', 'durations'));
    }

    public function show($slug)
    {
        $city = City::where('slug', $slug)->first();

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }
        $categoriesByCity = $this->getCategoriesByCity($city->slug);
        $coursesByCity = $this->getCoursesByCity($city->slug);

        return view('screen.city', compact('city', 'categoriesByCity', 'coursesByCity'));
    }

    private function getCategoriesByCity($slug)
    {
        $city = City::where('slug', $slug)->first();

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        // Get all categories available in the city
        $categories = Category::whereHas('courses.timings', function ($query) use ($city) {
            $query->where('city_id', $city->id);
        })->get()
            ->map(function ($category) {
                $category->media_url = $category->getFirstMediaUrl('images');
                return $category;
            });

        // Return the categories
        return response()->json($categories);
    }

    private function getCoursesByCity($slug)
    {
        $city = City::where('slug', $slug)->first();

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        // Get all courses available in the city
        $courses = Course::whereHas('timings', function ($query) use ($city) {
            $query->where('city_id', $city->id);
        })->get();

        // Return the courses
        return response()->json($courses);
    }
}
