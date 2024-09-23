<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\City;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCityDetailsRequest;
use App\Http\Requests\UpdateCityDetailsRequest;
use App\Http\Requests\UpdateCitySEORequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CityController extends Controller
{
    // Show cities page english & arabic
    public function index(Request $request)
    {
        try {
            $lang = $request->input('lang');
            $query = City::query();

            if ($lang) {
                $query->where('lang', $lang);
            }

            $cities = $query->get();

            // Add image URLs to each city
            $cities->transform(function ($city) {
                // Check if the city has associated media
                if ($city->getFirstMediaUrl('images')) {
                    $city->image = $city->getFirstMediaUrl('images');
                } else {
                    $city->image = null;
                }
                unset($city->media);
                return $city;
            });

            return response()->json($cities, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve cities', 'message' => $e->getMessage()], 500);
        }
    }

    // Create new city
    public function store(StoreCityDetailsRequest $request)
    {
        try {
            $validatedData = $request->validated();

            // Create the city
            $city = City::create($validatedData);

            // Handle image upload and association
            if ($request->hasFile('image')) {
                $city->addMediaFromRequest('image')->toMediaCollection('images');
            }

            // Retrieve the image URL if an image was uploaded
            $imageUrl = $city->getFirstMediaUrl('images');

            // Include the image URL in the response
            unset($city->media);
            $response = $city->toArray();
            $response['image_url'] = $imageUrl;

            return response()->json($response, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create City', 'message' => $e->getMessage()], 500);
        }
    }


    // Show city
    public function show($slug)
    {
        try {
            // Find the City by slug
            $city = City::where('slug', $slug)->firstOrFail();

            // Initialize the $image variable
            $image = null;

            // Load the media associated with the City
            if ($city->getFirstMediaUrl('images')) {
                $image = $city->getFirstMediaUrl('images');
            }

            // Add the image URL to the City attributes
            $cityData = $city->toArray();
            $cityData['image'] = $image;

            return response()->json($cityData, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'City not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve city', 'message' => $e->getMessage()], 500);
        }
    }


    // Update city details
    public function update(UpdateCityDetailsRequest $request, $slug)
    {
        try {
            $validatedData = $request->validated();

            // Find the City by slug
            $city = City::where('slug', $slug)->firstOrFail();

            $city->update($validatedData);

            // Handle image upload and association
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $city
                    ->clearMediaCollection('images')
                    ->addMedia($image)
                    ->toMediaCollection('images');
            }

            $city->save();

            // Retrieve the image URL if an image was uploaded
            $imageUrl = $city->getFirstMediaUrl('images');

            // Include the image URL in the response
            unset($city->media);
            $response = $city->toArray();
            $response['image_url'] = $imageUrl;

            return response()->json($response, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'City not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update city', 'message' => $e->getMessage()], 500);
        }
    }

    // Update City SEO
    public function updateSEO(UpdateCitySEORequest $request, $slug)
    {
        try {
            $validatedData = $request->validated();

            // Find the City by slug
            $city = City::where('slug', $slug)->firstOrFail();

            $city->update($validatedData);
            return response()->json($city, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'City not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update city SEO', 'message' => $e->getMessage()], 500);
        }
    }

    // Bulk toggle hidden status for Cities
    public function bulkHide(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:cities,id'
        ]);

        // Get the array of IDs from the request
        $ids = $request->input('ids');

        // Perform the bulk update to toggle the hidden status and get the number of affected rows
        $affectedRows = 0;
        $cities = City::whereIn('id', $ids)->get();

        foreach ($cities as $city) {
            $city->hidden = !$city->hidden;
            $city->save();
            $affectedRows++;
        }

        if ($affectedRows === 0) {
            return response()->json(['error' => 'No Cities were updated.'], 404);
        }

        return response()->json(['message' => "$affectedRows Cities updated successfully."], 200);
    }
}