<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maladie;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Maladies",
 *     description="API Endpoints of Maladies Microservice"
 * )
 */
class MaladieController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/maladies",
     *     tags={"Maladies"},
     *     summary="Get all maladies",
     *     @OA\Response(response=200, description="List of maladies")
     * )
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Maladie::all()
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/maladies",
     *     tags={"Maladies"},
     *     summary="Create a new maladie",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Diabète de type 2"),
     *             @OA\Property(property="rare", type="boolean", example=false)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Maladie created"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'rare' => 'boolean'
        ]);

        $maladie = Maladie::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $maladie
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/maladies/{id}",
     *     tags={"Maladies"},
     *     summary="Get a single maladie",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Maladie details"),
     *     @OA\Response(response=404, description="Maladie not found")
     * )
     */
    public function show($id)
    {
        $maladie = Maladie::find($id);

        if (!$maladie) {
            return response()->json(['status' => 'error', 'message' => 'Maladie not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $maladie], 200);
    }

    // Similar annotations can be added for update() and destroy()
}