<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Course;
use App\Models\Timing;
use App\Services\CourseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
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

        // Filter categories by language and hidden, and load media URL
        $categories = Category::where('lang', $currentLocale)->where('hidden', false)->get()->map(function ($category) {
            $category->media_url = $category->getFirstMediaUrl('images'); // Replace 'images' with your actual collection name
            return $category;
        });

        // Filter cities by language and hidden
        $cities = City::where('lang', $currentLocale)->where('hidden', false)->get();
        // Fetch durations
        $durations = Timing::select('duration')->distinct()->pluck('duration');

        return view('screen.categories', compact('timings', 'categories', 'cities', 'durations'));
    }

    public function show($slug)
    {

        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $categoryCourses = $this->getCategoryCourses($category);
        return view('screen.courses', compact('category', 'categoryCourses'));
    }

    public function showCoursesViaCity($venueslug, $categoryslug)
    {

        $category = Category::where('slug', $categoryslug)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $categoryCourses = $this->getCategoryCourses($category);
        return view('screen.courses', compact('category', 'categoryCourses'));
    }

    private function getCategoryCourses($category)
    {
        try {
            $currentLocale = app()->getLocale(); // Get the current language

            // Find the category by the provided ID or slug
            // $category = Category::where('id', $category)->orWhere('slug', $category)->first();
            Log::info("message =============");
            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            // Retrieve the courses associated with the category, filtered by lang and hidden fields
            $courses = $category->courses()
                ->where('lang', $currentLocale)
                ->where('hidden', false)
                ->get(['id', 'title', 'slug', 'description', 'lang', 'hidden']);

            return $courses;
            // return response()->json(['courses' => $courses], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve timings.', 'message' => $e->getMessage()], 500);
        }
    }
}
