<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user);
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
        try  {
            $validations = Validator::make($request->all(), [
                'name' => 'required|min:3',
                'email' => 'required|min:3|unique:users',
                'password' => 'required|min:3',
                'cpf' => 'nullable',
                'gender' => 'nullable',
                'birthdate' => 'nullable',
                'city_id' => 'nullable',
                'state_id' => 'nullable'
            ]);
    
            if ($validations->fails()) {
                return response()->json(['message' => 'A validação falhou.']);
            }
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'cpf' => $request->cpf,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'city_id' => $request->city_id,
                'state_id' => $request->state_id
            ]);
    
            return response()->json($user);
        } catch(Exception $e) {
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