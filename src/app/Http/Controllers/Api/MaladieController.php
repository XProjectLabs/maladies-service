<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maladie;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MaladieController extends Controller
{
    // GET /api/maladies
    public function index()
    {
        $maladies = Maladie::all();

        return response()->json([
            'status' => 'success',
            'data' => $maladies
        ], 200);
    }

    // POST /api/maladies
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'rare' => 'boolean'
            ]);

            $maladie = Maladie::create($data);

            return response()->json([
                'status' => 'success',
                'data' => $maladie
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        }
    }

    // GET /api/maladies/{id}
    public function show($id)
    {
        $maladie = Maladie::find($id);

        if (!$maladie) {
            return response()->json([
                'status' => 'error',
                'message' => 'Maladie not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $maladie
        ], 200);
    }

    // PUT /api/maladies/{id}
    public function update(Request $request, $id)
    {
        $maladie = Maladie::find($id);

        if (!$maladie) {
            return response()->json([
                'status' => 'error',
                'message' => 'Maladie not found'
            ], 404);
        }

        try {
            $data = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'rare' => 'sometimes|boolean'
            ]);

            $maladie->update($data);

            return response()->json([
                'status' => 'success',
                'data' => $maladie
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        }
    }

    // DELETE /api/maladies/{id}
    public function destroy($id)
    {
        $maladie = Maladie::find($id);

        if (!$maladie) {
            return response()->json([
                'status' => 'error',
                'message' => 'Maladie not found'
            ], 404);
        }

        $maladie->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Maladie deleted successfully'
        ], 200);
    }
}