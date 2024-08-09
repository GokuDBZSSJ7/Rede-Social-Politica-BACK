<?php

namespace App\Http\Controllers;

use App\Models\CurrentPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrentPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentPosition = CurrentPosition::all();
        return response()->json($currentPosition);
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
            'title' => 'required',
            'description' => 'required',
            'candidate_id' => 'required'
        ]);

        if ($validations->fails()) {
            return response()->json(['message' => 'erro de validação'], 500);
        }

        $currentPosition = CurrentPosition::create([
            'title' => $request->title,
            'description' => $request->description,
            'candidate_id' => $request->candidate_id
        ]);

        return response()->json($currentPosition);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $currentPosition = CurrentPosition::find($id);
        return response()->json($currentPosition);
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
        $currentPosition = CurrentPosition::find($id);
        $currentPosition->update($request->all());

        return response()->json($currentPosition);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $currentPosition = CurrentPosition::find($id);
        $currentPosition->delete();

        return response()->json(['message' => 'Deletado com sucesso'], 200);
    }
}
