<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Picture;

class PictureController extends Controller
{
    // Salvarea fotografiei in folderul public
    public function savePicture(Request $request)
    {
        $image = $request->image;

        if ($image != null) {

            $base64Image = explode(";base64,", $image);
            $explodeImage = explode("image/", $base64Image[0]);
            $imageType = $explodeImage[1];
            $image_base64 = base64_decode($base64Image[1]);
            $folderPath = "img/";
            $file = $folderPath . uniqid() . '.' . $imageType;
            file_put_contents($file, $image_base64);

            $picture = new Picture();
            $picture->name = $file;
            $picture->user_id = $request->userId;
            $picture->save();

            return response()->json(['image' => '$file'], 200);
        }

        return response()->json(['message' => 'Imaginea nu a putut fi încarcata.'], 400);
    }

    // Extragerea tuturor fotografiilor si returnarea acestora
    public function getAll(Request $request)
    {

        return Picture::all();
    }

    // Extragerea unei fotografii in functie de id
    public function getByUserId(Request $request, $userId)
    {

        return Picture::where('user_id', $userId)->get();
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