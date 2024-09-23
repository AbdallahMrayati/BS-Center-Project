<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMetaRequest;
use App\Http\Requests\UpdateMetaRequest;
use App\Models\Meta;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function show($id)
    {
        try {
            // Find the meta by id
            $meta = Meta::findOrFail($id);

            // Initialize the $image variable
            $image = null;

            // Load the media associated with the meta
            if ($meta->getFirstMediaUrl('images')) {
                $image = $meta->getFirstMediaUrl('images');
            }

            // Add the image URL to the meta attributes
            $metaData = $meta->toArray();
            $metaData['image'] = $image;

            return response()->json($metaData, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'meta not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve meta', 'message' => $e->getMessage()], 500);
        }
    }

    // Update meta
    public function update(UpdateMetaRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();

            // Find the meta by id
            $meta = Meta::findOrFail($id);

            // Update the meta with the new data
            $meta->update($validatedData);

            // Initialize arrays to store image URLs
            $imageUrl = $meta->getFirstMediaUrl('images');

            // Handle image upload and association
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $meta
                    ->clearMediaCollection('images') // Clear the old image
                    ->addMedia($image)
                    ->toMediaCollection('images');

                // Get the updated URL of the single image
                $imageUrl = $meta->getFirstMediaUrl('images');
            }

            // Include the image URLs in the response
            $response = [
                'meta' => $meta,
                'image_url' => $imageUrl,
            ];

            return response()->json($response, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'meta not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update meta', 'message' => $e->getMessage()], 500);
        }
    }
}