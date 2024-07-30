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
        try {
            $post = Post::all();
            return response()->json($post);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', $e], 500);
        }
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
                'user_id' => 'required',
                'candidate_id' => 'required'
            ]);

            if ($validations->fails()) {
                return response()->json(['message' => 'A validação falhou']);
            }

            $post = Post::create([
                'description' => $request->description,
                'image_url' => $request->image_url,
                'likes' => 0,
                'dislikes' => 0,
                'user_id' => $request->user_id,
                'candidate_id' => $request->candidate_id
            ]);

            $post->load('user');
            $post->load('candidate');

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
        try {
            $post = Post::find($id);
            return response()->json($post);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', $e], 500);
        }
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
        try {
            $post  = Post::find($id);
            $post->update($request->all());
            return response()->json(['message' => 'Atualizaco com sucesso']);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::find($id);
            $post->delete();
            return response()->json(['message' => 'Deletado com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', $e], 500);
        }
    }
}