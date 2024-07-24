<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = Comment::all();
        return response()->json($comment);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
