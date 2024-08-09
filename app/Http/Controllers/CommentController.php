<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $comment = Comment::all();
            $comment->load('replie');
            return response()->json($comment);
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
            $validations = Validator::make([
                'attachment' => 'nullable|string',
                'text' => 'required|string',
                'post_id' => 'required',
                'user_id' => 'required'
            ]);

            if ($validations->fails()) {
                return response()->json(['message' => 'Erro de validação']);
            }

            $comment = Comment::create($request->all(), [
                'attachment' => $request->attachment,
                'text' => $request->text,
                'likes' => $request->likes,
                'deslikes' => $request->deslikes,
                'post_id' => $request->post_id,
                'user_id' => $request->user_id
            ]);

            return response()->json($comment);
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
            $comment = Comment::find($id);
            return response()->json($comment);
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
            $comment = Comment::find($id);
            $comment->update($request->all());
            return response()->json($comment);
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
            $comment = Comment::find($id);
            $comment->delete();
            return response()->json(['message' => 'Deletado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', $e], 500);
        }
    }
}
