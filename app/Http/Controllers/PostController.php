<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $post = Post::orderBy('created_at', 'desc')->get();
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
            $validated = $request->validate([
                'description' => 'required|string',
                'user_id' => 'required|integer',
                'candidate_id' => 'required|integer',
                'image_url' => 'nullable|string',
            ]);

            $imagePath = null;
            if ($request->image_url) {
                $imageData = $request->image_url;
                $base64Image = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
                $imageName = time() . '.jpg';
                $imagePath = 'images/' . $imageName;
                Storage::disk('public')->put($imagePath, base64_decode($base64Image));
            }

            $data = $request->only(['description', 'user_id', 'candidate_id']);
            if ($imagePath) {
                $data['image_url'] = $imagePath;
            }

            $post = Post::create($data);

            $post->load('user');
            $post->load('candidate');

            return response()->json($post);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao processar a solicitação', 'error' => $e->getMessage()], 500);
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

    public function addLike($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->likes += 1;

        $post->save();

        return response()->json(['likes' => $post->likes]);
    }

    public function removeLike($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->likes -= 1;

        $post->save();

        return response()->json(['likes' => $post->likes]);
    }
}
