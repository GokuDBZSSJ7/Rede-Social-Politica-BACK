<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposal = Proposal::all();
        return response()->json($proposal);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $validations = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'candidate_id' => 'required',
            'expected_impact' => 'nullable'
        ]);

        if ($validations->fails()) {
            return response()->json("Validação Falhou");
        }

        $proposal = Proposal::create([
            'title' => $request->title,
            'description' => $request->description,
            'candidate_id' => $request->candidate_id,
            'expected_impact' => $request->expected_impact
        ]);

        return response()->json($proposal);
    }





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
