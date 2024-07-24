<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        return response()->json($post);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validations = Validator::make($request->all(), [
                'description' => 'required|string',
                'image_url' => 'string|nullable',
                'user_id' => 'required'
            ]);

            if ($validations->fails()) {
                return response()->json(['message' => 'A validação falhou']);
            }

            $post = Post::create([
                'description' => $request->description,
                'image_url' => $request->image_url,
                'user_id' => $request->user_id
            ]);

            return response()->json($post);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post  = Post::find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
