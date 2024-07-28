<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $position = Position::all();
        return response()->json($position);
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
            'name' => 'required',
            'description' => 'required',
            'term_period' => 'required',
            'jurisdiction' => 'required',
            'requirements' => 'required'
        ]);

        if($validations->fails()) {
            return response()->json("Erro de Validação");
        }

        $position = Position::create([
            'name' => $request->name,
            'description' => $request->description,
            'term_period' => $request->term_period,
            'jurisdiction' => $request->jurisdiction,
            'requirements' => $request->requirements
        ]);

        return response()->json($position);
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
