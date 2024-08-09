<?php

namespace App\Http\Controllers;

use App\Models\Replie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $replie = Replie::all();
            return response()->json($replie);
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
        $validations = Validator::make($request->all(), [
            'text' => 'required',
            'comment_id' => 'required'
        ]);

        if ($validations->fails()) {
            return response()->json(['message' => 'Erro de validação'], 500);
        }

        $replie = Replie::create([
            'text' => $request->text,
            'comment_id' => $request->comment_id
        ]);

        return response()->json($replie);
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
    public function update(Request $request, $id)
    {
        $replie = Replie::find($id);
        $replie->update($request->all());

        return response()->json($replie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $replie = Replie::find($id);
        $replie->delete();

        return response()->json(['message' => 'Deletado com sucesso'], 200);
    }
}
