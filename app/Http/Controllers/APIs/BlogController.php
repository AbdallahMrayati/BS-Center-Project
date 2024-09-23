<?php

namespace App\Http\Controllers\APIs;

use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogDetailsRequest;
use App\Http\Requests\UpdateBlogSEORequest;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('permission:blog-list|blog-create|blog-edit|blog-hide', ['only' => ['index', 'show']]);
        // $this->middleware('permission:blog-create', ['only' => ['store']]);
        // $this->middleware('permission:blog-edit', ['only' => ['update', 'updateSEO']]);
        // $this->middleware('permission:blog-hide', ['only' => ['bulkHide']]);
    }

    // Show Blogs page english & arabic
    public function index(Request $request)
    {
        try {
            $lang = $request->input('lang');
            $query = Blog::query();

            if ($lang) {
                $query->where('lang', $lang);
            }

            $blogs = $query->get();

            // Add image URLs to each blog
            $blogs->transform(function ($blog) {
                // Check if the blog has associated media
                if ($blog && $blog->getFirstMediaUrl('images')) {
                    $blog->image = $blog->getFirstMediaUrl('images');
                } else {
                    $blog->image = null;
                }
                return $blog;
            });

            return response()->json($blogs, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve blogs', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(StoreBlogRequest $request)
    {
        try {
            $validatedData = $request->validated();

            // Create the blog
            $blog = Blog::create($validatedData);

            // Initialize arrays to store image URLs
            $imageUrl = null;

            // Handle image upload and association
            if ($request->hasFile('image')) {
                $media = $blog->addMediaFromRequest('image')->toMediaCollection('images');
                $imageUrl = $media->getUrl();  // Get the URL of the single image
            }

            // Include the image URLs in the response
            $response = [
                'blog' => $blog,
                'image_url' => $imageUrl,
            ];

            return response()->json($response, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create blog', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($slug)
    {
        try {
            // Find the blog by slug
            $blog = Blog::where('slug', $slug)->firstOrFail();

            // Initialize the $image variable
            $image = null;

            // Load the media associated with the blog
            if ($blog->getFirstMediaUrl('images')) {
                $image = $blog->getFirstMediaUrl('images');
            }

            // Add the image URL to the blog attributes
            $blogData = $blog->toArray();
            $blogData['image'] = $image;

            return response()->json($blogData, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'blog not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve blog', 'message' => $e->getMessage()], 500);
        }
    }

    // Update blog details
    public function update(UpdateBlogDetailsRequest $request, $slug)
    {
        try {
            $validatedData = $request->validated();

            // Find the blog by slug
            $blog = Blog::where('slug', $slug)->firstOrFail();

            // Update the blog with the new data
            $blog->update($validatedData);

            // Initialize arrays to store image URLs
            $imageUrl = $blog->getFirstMediaUrl('images');

            // Handle image upload and association
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $blog
                    ->clearMediaCollection('images') // Clear the old image
                    ->addMedia($image)
                    ->toMediaCollection('images');

                // Get the updated URL of the single image
                $imageUrl = $blog->getFirstMediaUrl('images');
            }

            // Include the image URLs in the response
            $response = [
                'blog' => $blog,
                'image_url' => $imageUrl,
            ];

            return response()->json($response, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'blog not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update blog', 'message' => $e->getMessage()], 500);
        }
    }

    // Update blog SEO
    public function updateSEO(UpdateBlogSEORequest $request, $slug)
    {
        try {
            $validatedData = $request->validated();

            // Find the blog by slug
            $blog = Blog::where('slug', $slug)->firstOrFail();

            $blog->update($validatedData);
            return response()->json($blog, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'blog not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update blog SEO', 'message' => $e->getMessage()], 500);
        }
    }

    // Bulk toggle hidden status for blogs
    public function bulkHide(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:blogs,id'
        ]);

        // Get the array of IDs from the request
        $ids = $request->input('ids');

        // Perform the bulk update to toggle the hidden status and get the number of affected rows
        $affectedRows = 0;
        $blogs = Blog::whereIn('id', $ids)->get();

        foreach ($blogs as $blog) {
            $blog->hidden = !$blog->hidden;
            $blog->save();
            $affectedRows++;
        }

        if ($affectedRows === 0) {
            return response()->json(['error' => 'No blogs were updated.'], 404);
        }

        return response()->json(['message' => "$affectedRows blogs updated successfully."], 200);
    }
}