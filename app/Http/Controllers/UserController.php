<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::all();
            return response()->json($user);
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
                'name' => 'required|min:3',
                'email' => 'required|min:3|unique:users',
                'password' => 'required|min:3',
                'cpf' => 'nullable',
                'gender' => 'nullable',
                'birthdate' => 'nullable',
                'city_id' => 'nullable',
                'state_id' => 'nullable',
                'image_url' => 'nullable'

            ]);

            if ($validations->fails()) {
                return response()->json(['message' => 'A validação falhou.']);
            }

            $imagePath = null;
            if ($request->has('image_url') && !empty($request->image_url)) {
                $imageData = $request->image_url;
                $base64Image = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
                $imageName = time() . '.jpg';
                $imagePath = 'images/candidate/' . $imageName;
                Storage::disk('public')->put($imagePath, base64_decode($base64Image));
            }

            $data = $request->only(['description', 'user_id', 'candidate_id']);
            if ($imagePath) {
                $data['image_url'] = $imagePath;
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
            $user = User::find($id);
            return response()->json($user);
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
            $user  = User::find($id);
            $user->update($request->all());
            return response()->json(['message' => 'Atualizaco com sucesso']);
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
            $user = User::find($id);
            $user->delete();
            return response()->json(['message' => 'Deletado com sucesso']);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', $e], 500);
        }
    }

    public function getCandidateByUserId($userId)
    {
        $candidate = Candidate::where('user_id', $userId)->first();

        if (!$candidate) {
            return response()->json(['error' => 'Candidate not found for this user']);
        }

        return response()->json($candidate);
    }
}
