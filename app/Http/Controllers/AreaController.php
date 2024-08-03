<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $area = Area::where('candidate_id', $request->candidate_id)->get();
        return response()->json($area);
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

        if($validations->fails()) {
            return response()->json("Erro de Validação");
        }

        $area = Area::create([
            'title' => $request->title,
            'description' => $request->description,
            'candidate_id' => $request->candidate_id
        ]);

        return response()->json($area);
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
