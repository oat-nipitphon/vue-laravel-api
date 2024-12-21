<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\UpdateAuthRequest;
use App\Models\User;
use App\Models\Post;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        try {

            return response()->json([
                'users' => User::all(),
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }

    }

    public function register (Request $request) {

        try {

            $fields = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
                'status' => 'required'
            ]);
    
            $user = User::create($fields);
            $token = $user->createToken($request->name);
            
            return response()->json([
                'user' => $user,
                'token' => $token->plainTextToken,
                'message' => 'register user success.'
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }
        
    }

    public function login(Request $request) {

        try {

            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string'
            ]);
            
            $user = User::where('email', $request->email)->first();
        
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'The provided credentials are incorrect.'
                ], 401); 
            }
        
            $token = $user->createToken($user->name);
    
            return response()->json([
                'user' => $user,
                'token' => $token->plainTextToken,
                'message' => 'Login successful.'
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }

    }

    public function logout(Request $request)
    {
        try {
            // ลบทุก token ของผู้ใช้ (Sanctum)
            $request->user()->tokens()->delete();
    
            return response()->json([
                'message' => 'Logout success.'
            ], 200);
    
        } catch (\Exception $e) {
            // หากเกิดข้อผิดพลาด
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Auth $auth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthRequest $request, Auth $auth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auth $auth)
    {
        //
    }
}
