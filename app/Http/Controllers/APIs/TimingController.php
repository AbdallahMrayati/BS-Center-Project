<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTimingRequest;
use App\Http\Requests\UpdateTimingRequest;
use App\Jobs\UpdateTimingsJob;
use App\Models\Course;
use App\Models\Timing;
use Illuminate\Http\Request;
use Exception;

class TimingController extends Controller
{
    // Index method with search functionality
    public function index(Request $request)
    {
        $query = Timing::query();
        $lang = $request->input('lang');

        if ($lang) {
            $query->where('lang', $lang);
        }

        // Join with courses to filter by category_id
        if ($request->filled('category_id')) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('category_id', $request->input('category_id'));
            });
        }

        // Filter by city
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->input('city_id'));
        }

        // Filter by price
        if ($request->filled('price')) {
            $query->where('price', $request->input('price'));
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('date_from', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->where('date_to', '<=', $request->input('date_to'));
        }

        // Filter by duration
        if ($request->filled('duration')) {
            $query->where('duration', $request->input('duration'));
        }

        // Get the results without pagination
        $timings = $query->get()->map(function ($timing) {
            return [
                'id' => $timing->id,
                'title' => $timing->title,
                'price' => $timing->price,
                'date_from' => $timing->date_from,
                'date_to' => $timing->date_to,
                'duration' => $timing->duration,
                'lang' => $timing->lang,
                'city_title' => $timing->city->title ?? null,
                'course_title' => $timing->course->title ?? null,
                'category_title' => $timing->course->category->title ?? null,
                'is_upcoming' => $timing->is_upcoming,
                'is_banner' => $timing->is_banner,
                'hidden' => $timing->hidden,
            ];
        });

        return response()->json($timings, 200);
    }


    // Show timings for one course
    public function indexCourseTimings(Request $request, $slug)
    {
        try {
            $perPage = $request->input('per_page', config('pagination.per_page'));
            $course = Course::where('slug', $slug)->first();

            if (!$course) {
                return response()->json(['message' => 'Course not found'], 404);
            }

            $timings = $course->timings()->paginate($perPage);

            return response()->json($timings);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve timings.', 'message' => $e->getMessage()], 500);
        }
    }

    // Bulk toggle hidden status for timings
    public function bulkHide(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:timings,id'
        ]);

        // Get the array of IDs from the request
        $ids = $request->input('ids');

        // Perform the bulk update to toggle the hidden status and get the number of affected rows
        $affectedRows = 0;
        $timings = Timing::whereIn('id', $ids)->get();

        foreach ($timings as $timing) {
            $timing->hidden = !$timing->hidden;
            $timing->save();
            $affectedRows++;
        }

        if ($affectedRows === 0) {
            return response()->json(['error' => 'No timings were updated.'], 404);
        }

        return response()->json(['message' => "$affectedRows timings updated successfully."], 200);
    }

    // Add new timings
    public function store(StoreTimingRequest $request, $slug)
    {
        try {
            // Retrieve the course by slug
            $course = Course::where('slug', $slug)->first();

            if (!$course) {
                return response()->json(['message' => 'Course not found'], 404);
            }

            // Merge course_id, title, and lang into the request data
            $timingData = $request->validated();
            $timingData['course_id'] = $course->id;
            $timingData['title'] = $course->title;
            $timingData['lang'] = $course->lang;

            // Create the timing
            $timing = Timing::create($timingData);

            return response()->json($timing, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create timing.', 'message' => $e->getMessage()], 500);
        }
    }

    // Toggle is_banner
    public function toggleBanner($id)
    {
        try {
            // Find the timing by ID
            $timing = Timing::findOrFail($id);

            // Toggle the is_banner value
            $timing->is_banner = !$timing->is_banner;

            // Save the changes
            $timing->save();

            return response()->json([
                'message' => 'Timing is_banner updated successfully.',
                'timing' => $timing
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update is_banner.', 'message' => $e->getMessage()], 500);
        }
    }

    // Toggle is_upcoming
    public function toggleUpcoming($id)
    {
        try {
            // Find the timing by ID
            $timing = Timing::findOrFail($id);

            // Toggle the is_upcoming value
            $timing->is_upcoming = !$timing->is_upcoming;

            // Save the changes
            $timing->save();

            return response()->json([
                'message' => 'Timing is_upcoming updated successfully.',
                'timing' => $timing
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update is_upcoming.', 'message' => $e->getMessage()], 500);
        }
    }

    // Search

    // Batch update
    public function timingBatchUpdate(UpdateTimingRequest $request)
    {
        try {
            // Validate and get the validated data
            $validatedData = $request->validated();

            // Extract the selected timings and new values
            $selectedTimings = $validatedData['selected_timings'];
            $newValues = $request->except('selected_timings');

            // Dispatch the job to update the timings
            UpdateTimingsJob::dispatch($selectedTimings, $newValues);

            // Retrieve the information of the selected timings
            $timingsInfo = Timing::whereIn('id', $selectedTimings)->get();

            // Return the response with the list of selected timings info
            return response()->json([
                'message' => 'Timings update job dispatched successfully',
                'selected_timings' => $timingsInfo,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to dispatch timing update job.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}