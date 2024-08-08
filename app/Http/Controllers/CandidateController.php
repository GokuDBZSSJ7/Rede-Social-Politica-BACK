<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $candidate = Candidate::all();
            return response()->json($candidate);
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
                'name' => 'required',
                'age' => 'required',
                'email' => 'required',
                'education' => 'required',
                'experience' => 'required',
                'gender' => 'required',
                'phone' => 'required',
                'position_id' => 'required',
                'party_id' => 'required',
                'user_id' => 'required',
                'electoral_affiliation' => 'nullable',
                'electoral_number' => 'nullable',
                'city_id' => 'required',
                'state_id' => 'required',
            ]);

            if ($validations->fails()) {
                return response()->json(['message' => 'Erro de validação']);
            }

            $candidate = Candidate::create([
                'name' => $request->name,
                'age' => $request->age,
                'email' => $request->email,
                'education' => $request->education,
                'experience' => $request->experience,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'position_id' => $request->position_id,
                'party_id' => $request->party_id,
                'user_id' => $request->user_id,
                'electoral_affiliation' => $request->electoral_affiliation,
                'electoral_number' => $request->electoral_number,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'image_url' => $request->image_url,
                'status' => 'pendente'
            ]);



            $candidate->load('user');
            $candidate->load('party');
            $candidate->load('position');
            $candidate->load('city');
            $candidate->load('state');

            return response()->json($candidate);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', $e], 500);
        }
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
