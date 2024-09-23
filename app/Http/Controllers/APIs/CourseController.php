<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseDetailsRequest;
use App\Http\Requests\UpdateCourseDetailsRequest;
use App\Http\Requests\UpdateCourseSEORequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Show courses with lang 'en' or 'ar', pagination, and search functionality
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', config('pagination.per_page'));
            $lang = $request->input('lang');
            $search = $request->input('search');

            $query = Course::query();

            if ($lang) {
                $query->where('lang', $lang);
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('h1', 'like', "%{$search}%");
                });
            }

            $courses = $query->with('category:id,title')
                ->paginate($perPage);

            // Add image URLs to each course
            $courses->transform(function ($course) {
                // Initialize the $image variable
                $image = null;

                // Check if the course has associated media
                if ($course->getFirstMediaUrl('images')) {
                    $image = $course->getFirstMediaUrl('images');
                }

                // Add the image URL to the course object
                $course->image = $image;

                unset($course->media);
                return $course;
            });

            return response()->json($courses, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve courses.', 'message' => $e->getMessage()], 500);
        }
    }

    // Create new course with course details
    public function store(StoreCourseDetailsRequest $request)
    {
        try {
            $validatedData = $request->validated();

            // Create the course
            $course = Course::create($validatedData);

            // Handle image upload and association
            if ($request->hasFile('image')) {
                $course->addMediaFromRequest('image')->toMediaCollection('images');
            }

            // Retrieve the image URL if an image was uploaded
            $imageUrl = $course->getFirstMediaUrl('images');

            // Include the image URL in the response
            unset($course->media);
            $response = $course->toArray();
            $response['image_url'] = $imageUrl;

            return response()->json($response, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create course.', 'message' => $e->getMessage()], 500);
        }
    }

    // Show course fields
    public function show($slug)
    {
        try {
            // Find the course by slug and eager load any required relationships
            $course = Course::with('media')->where('slug', $slug)->firstOrFail();

            // Initialize the $image variable
            $image = null;

            // Check if the course has associated media
            if ($course->getFirstMediaUrl('images')) {
                $image = $course->getFirstMediaUrl('images');
            }

            // Add the image URL to the course object
            $courseData = $course->toArray();
            $courseData['image'] = $image;

            return response()->json($courseData, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Course not found', 'message' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve course.', 'message' => $e->getMessage()], 500);
        }
    }


    // update course details
    public function update(UpdateCourseDetailsRequest $request, $slug)
    {
        try {
            // Find the course by slug
            $course = Course::where('slug', $slug)->firstOrFail();

            $course->update($request->validated());
            $imageUrl = $course->getFirstMediaUrl('images');

            // Handle image upload and association
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $course
                    ->clearMediaCollection('images')
                    ->addMedia($image)
                    ->toMediaCollection('images');
                // Get the updated URL of the single image
                $imageUrl = $course->getFirstMediaUrl('images');
            }

            // Include the image URL in the response
            unset($course->media);
            $response = $course->toArray();
            $response['image_url'] = $imageUrl;

            return response()->json($response, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Course not found', 'message' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update course.', 'message' => $e->getMessage()], 500);
        }
    }

    // Update course SEO
    public function updateSEO(UpdateCourseSEORequest $request, $slug)
    {
        try {
            // Find the course by slug
            $course = Course::where('slug', $slug)->firstOrFail();
            $course->update($request->validated());
            return response()->json($course, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Course not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update course SEO', 'message' => $e->getMessage()], 500);
        }
    }

    // Bulk toggle hidden status for courses
    public function bulkHide(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:courses,id'
        ]);

        // Get the array of IDs from the request
        $ids = $request->input('ids');

        // Perform the bulk update to toggle the hidden status and get the number of affected rows
        $affectedRows = 0;
        $courses = Course::whereIn('id', $ids)->get();

        foreach ($courses as $course) {
            $course->hidden = !$course->hidden;
            $course->save();
            $affectedRows++;
        }

        if ($affectedRows === 0) {
            return response()->json(['error' => 'No courses were updated.'], 404);
        }

        return response()->json(['message' => "$affectedRows courses updated successfully."], 200);
    }
}