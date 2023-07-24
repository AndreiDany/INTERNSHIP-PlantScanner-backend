<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Picture;

class PictureController extends Controller
{
    // Extragerea tuturor fotografiilor si returnarea acestora
    public function getAll(Request $request)
    {

        return Picture::all();
    }

    // Extragerea unei fotografii in functie de id
    public function getById(Request $request, $pictureId)
    {

        return Picture::where('id', $pictureId)->get();
    }

    // Create, update, delete
    function addPicture(Request $request)
    {

        return Picture::create($request->all());
    }

    function editPicture(Request $request, $pictureId)
    {
        try {
            $picture = Picture::findOrFail($pictureId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Picture not found.'
            ], 403);
        }

        $jsonData = $request->all();
        $name = $jsonData['name'];
        $picture->update(['name' => $name]);

        return response()->json(['message' => 'Picture updated successfully.']);
    }

    function deletePicture(Request $request, $pictureId)
    {

        try {
            $picture = Picture::findOrFail($pictureId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Picture not found.'
            ], 403);
        }

        $picture->delete();

        return response()->json(['message' => 'Picture deleted successfully.']);
    }
}