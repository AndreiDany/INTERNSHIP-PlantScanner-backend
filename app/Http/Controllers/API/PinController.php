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

    // Verificarea daca un pin trimis din frontend exista in baza de date
    public function verifyPin(Request $request)
    {
        $jsonData = $request->all();
        $pin = $jsonData['pin'];

        $pinExists = Pin::where('pin', $pin)->exists();

        if ($pinExists) {
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['message' => 'Error: Pin does not exist in the database.'], 404);
        }
    }

    // Create, update
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
}