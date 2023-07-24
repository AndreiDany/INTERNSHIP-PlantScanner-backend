<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Pin;

class PinController extends Controller
{
    // Extragerea tuturor pin-urilor si returnarea acestora
    public function getAll(Request $request)
    {

        return Pin::all();
    }

    // Extragerea unui pin in functie de id
    public function getById(Request $request, $pinId)
    {

        return Pin::where('id', $pinId)->get();
    }

    // Create, update, delete
    function addPin(Request $request)
    {

        return Pin::create($request->all());
    }

    function editPin(Request $request, $pinId)
    {
        try {
            $pin = Pin::findOrFail($pinId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Pin not found.'
            ], 403);
        }

        $jsonData = $request->all();
        $p = $jsonData['pin'];
        $pin->update(['pin' => $p]);

        return response()->json(['message' => 'Pin updated successfully.']);
    }

    function deletePin(Request $request, $pinId)
    {

        try {
            $pin = Pin::findOrFail($pinId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Pin not found.'
            ], 403);
        }

        $pin->delete();

        return response()->json(['message' => 'Pin deleted successfully.']);
    }
}