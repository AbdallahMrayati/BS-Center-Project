<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryDetailsRequest;
use App\Http\Requests\UpdateCategoryDetailsRequest;
use App\Http\Requests\UpdateCategorySEORequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    // Show Categories page english & arabic
    public function index(Request $request)
    {
        try {
            $lang = $request->input('lang');
            $query = Category::query();

            if ($lang) {
                $query->where('lang', $lang);
            }

            $categories = $query->get();

            // Add image URLs to each category
            $categories->transform(function ($category) {
                // Check if the category has associated media
                if ($category && $category->getFirstMediaUrl('images')) {
                    $category->image = $category->getFirstMediaUrl('images');
                } else {
                    $category->image = null;
                }
                return $category;
            });

            return response()->json($categories, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve categories', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(StoreCategoryDetailsRequest $request)
    {
        try {
            $validatedData = $request->validated();

            // Create the category
            $category = Category::create($validatedData);

            // Initialize arrays to store image URLs
            $imageUrl = null;
            $multiImagesUrls = [];

            // Handle image upload and association
            if ($request->hasFile('image')) {
                $media = $category->addMediaFromRequest('image')->toMediaCollection('images');
                $imageUrl = $media->getFullUrl();  // Get the URL of the single image
            }

            // Handle multi images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $media = $category->addMedia($image)->toMediaCollection('multi_images');
                    $multiImagesUrls[] = $media->getFullUrl();  // Get the URL of each multi image
                }
            }

            // Include the image URLs in the response
            $response = [
                'category' => $category,
                'image_url' => $imageUrl,
                'multi_images_urls' => $multiImagesUrls,
            ];

            return response()->json($response, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create category', 'message' => $e->getMessage()], 500);
        }
    }

    // get multi images for a category
    public function getMultiImages($slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();

            // Retrieve all media items in the 'multi_images' collection
            $mediaItems = $category->getMedia('multi_images');

            // Transform media items to include IDs and URLs
            $images = $mediaItems->map(function ($mediaItem) {
                return [
                    'id' => $mediaItem->id,
                    'url' => $mediaItem->getUrl(),
                ];
            });

            return response()->json($images, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve images', 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteMultiImage($slug, $mediaId)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            // Find the specific media item by its ID
            $mediaItem = $category->getMedia('multi_images')->where('id', $mediaId)->first();
            if ($mediaItem) {
                $mediaItem->delete();
                return response()->json(['message' => 'Image deleted successfully'], 200);
            } else {
                return response()->json(['error' => 'Image not found'], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete image', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($slug)
    {
        try {
            // Find the category by slug
            $category = Category::where('slug', $slug)->firstOrFail();

            // Initialize the $image variable
            $image = null;

            // Load the media associated with the category
            if ($category->getFirstMediaUrl('images')) {
                $image = $category->getFirstMediaUrl('images');
            }

            // Add the image URL to the category attributes
            $categoryData = $category->toArray();
            $categoryData['image'] = $image;

            return response()->json($categoryData, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve category', 'message' => $e->getMessage()], 500);
        }
    }

    // Update category details
    public function update(UpdateCategoryDetailsRequest $request, $slug)
    {
        try {
            $validatedData = $request->validated();

            // Find the category by slug
            $category = Category::where('slug', $slug)->firstOrFail();

            // Update the category with the new data
            $category->update($validatedData);

            // Initialize arrays to store image URLs
            $imageUrl = $category->getFirstMediaUrl('images');
            $multiImagesUrls = [];

            // Handle image upload and association
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $category
                    ->clearMediaCollection('images') // Clear the old image
                    ->addMedia($image)
                    ->toMediaCollection('images');

                // Get the updated URL of the single image
                $imageUrl = $category->getFirstMediaUrl('images');
            }

            // Handle multi images
            if ($request->hasFile('images')) {
                // Clear the existing multi_images collection before adding new images
                // $category->clearMediaCollection('multi_images');

                foreach ($request->file('images') as $image) {
                    $media = $category->addMedia($image)->toMediaCollection('multi_images');
                    $multiImagesUrls[] = $media->getUrl();  // Get the URL of each multi image
                }
                // Retain the existing images' URLs along with the new ones
$multiImagesUrls = $category->getMedia('multi_images')->map(function ($media) {
    return $media->getUrl();
})->toArray();
            } else {
                // If no new multi images were uploaded, retain the existing ones
                $multiImagesUrls = $category->getMedia('multi_images')->map(function ($media) {
                    return $media->getUrl();
                })->toArray();
            }

            // Include the image URLs in the response
            $response = [
                'category' => $category,
                'image_url' => $imageUrl,
                'multi_images_urls' => $multiImagesUrls,
            ];

            return response()->json($response, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update category', 'message' => $e->getMessage()], 500);
        }
    }

    // Update category SEO
    public function updateSEO(UpdateCategorySEORequest $request, $slug)
    {
        try {
            $validatedData = $request->validated();

            // Find the category by slug
            $category = Category::where('slug', $slug)->firstOrFail();

            $category->update($validatedData);
            return response()->json($category, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update category SEO', 'message' => $e->getMessage()], 500);
        }
    }

    // Bulk toggle hidden status for categories
    public function bulkHide(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:categories,id'
        ]);

        // Get the array of IDs from the request
        $ids = $request->input('ids');

        // Perform the bulk update to toggle the hidden status and get the number of affected rows
        $affectedRows = 0;
        $categories = Category::whereIn('id', $ids)->get();

        foreach ($categories as $category) {
            $category->hidden = !$category->hidden;
            $category->save();
            $affectedRows++;
        }

        if ($affectedRows === 0) {
            return response()->json(['error' => 'No categories were updated.'], 404);
        }

        return response()->json(['message' => "$affectedRows categories updated successfully."], 200);
    }
}