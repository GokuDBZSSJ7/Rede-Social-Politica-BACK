<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Party;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $party = Party::all();
            return response()->json($party);
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
                'name' => 'required|string',
                'acronym' => 'required',
                'founding_date' => 'required|date',
                'founders' => 'required',
                'description' => 'required|string',
                'statute' => 'required',
                'state_id' => 'required',
                'city_id' => 'required'
            ]);

            if ($validations->fails()) {
                return response()->json(['message' => 'Erro de validação']);
            }

            $party = Party::create([
                'name' => $request->name,
                'acronym' => $request->acronym,
                'founding_date' => $request->founding_date,
                'founders' => $request->founders,
                'description' => $request->description,
                'statute' => $request->statute,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id
            ]);

            return response()->json($party);
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
            $party = Party::find($id);
            return response()->json($party);
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
            $party = Party::find($id);
            $party->update($request->all());
            return response()->json(['message' => 'Atualizado com sucesso!']);
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
            $party = Party::find($id);

            $party->delete();
            return response()->json(['message' => 'Deletado com sucesso']);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', $e], 500);
        }
    }

    public function approveCandidate($id)
    {
        $candidate = Candidate::find($id);

        $candidate->status = "candidato_aprovado";
        $candidate->save();

        return response()->json($candidate);
    }
}
