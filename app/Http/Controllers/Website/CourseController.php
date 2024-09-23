<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Course;
use App\Models\Timing;
use Exception;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function show($slug)
    {
        $currentLocale = app()->getLocale(); // Get the current language

        $course = Course::with(['category', 'timings.city'])->where('slug', $slug)->firstOrFail();
        
        if($course['image']){
             $course['image'] = $course->getFirstMediaUrl('images');
        }else{
            $randomImage = Cache::get('random_image');
           $course['image'] = $randomImage->original_url;
        }
        

        
        $timings = $course->timings()
            ->where('hidden', false)
            ->where('lang', $currentLocale)
            ->get();

        $relatedCourses = $this->getRelatedTimings($course->slug);

        // return $course;

        return view('screen.course', compact(['course', 'timings', 'relatedCourses']));
    }

    public function getAllCourseTimings($slug)
    {
        try {
            $currentLocale = app()->getLocale(); // Get the current language
            $course = Course::where('slug', $slug)->first();

            if (!$course) {
                return response()->json(['message' => 'Course not found'], 404);
            }

            $timings = $course->timings()
                ->with('city')
                ->with('course')
                ->where('hidden', false)
                ->where('lang', $currentLocale)
                ->get();

            return response()->json(['timings' => $timings], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve timings.', 'message' => $e->getMessage()], 500);
        }
    }

    private function getRelatedTimings($slug)
    {
        try {
            Log::info("related courses controller");
            $currentLocale = app()->getLocale(); // Get the current language
            $course = Course::where('slug', $slug)->first();

            if (!$course) {
                return response()->json(['message' => 'Course not found'], 404);
            }

            $category_id = $course->category->id;

            $timings = Timing::with(['course', 'city'])
                ->whereHas('course', function ($query) use ($category_id) {
                    $query->where('category_id', $category_id);
                })
                ->where('hidden', false)
                ->where('lang', $currentLocale)
                ->get(['id', 'course_id', 'city_id', 'date_from', 'date_to'])
                ->map(function ($timing) {
                    if ($timing->course->getFirstMediaUrl('images')) {
                        $image = $timing->course->getFirstMediaUrl('images');
                    } else {
                        $image = $timing->course->category->getFirstMediaUrl('images');
                    }
                    return [
                        'id' => $timing->id,
                        'course_title' => $timing->course->title,
                        'course_slug' => $timing->course->slug,
                        'course_image' => $image,
                        'image_alt' => $timing->course->image_alt,
                        'h1' => $timing->course->h1,
                        'date_from' => $timing->date_from,
                        'date_to' => $timing->date_to,
                        'city_title' => $timing->city->title,
                    ];
                });

            return $timings;
            // return response()->json(['timings' => $timings], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve timings.', 'message' => $e->getMessage()], 500);
        }
    }
}