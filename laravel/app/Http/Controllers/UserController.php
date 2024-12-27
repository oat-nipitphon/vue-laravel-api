<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserPhoto;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $userProfilePhoto = User::with('userProfiles', 'userPhotos')->get();
            return response()->json([
                'req' => $userProfilePhoto,
                'message' => "laravel user controller get data success."
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'dataError' => $php_errormsg,
                'error' => $error,
                'message' => "laravel user controller get data error."
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        // 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Show user profile and photo
        try {
            return [
                $id
            ];
        } catch (\Exception $e) {
            return [
                $e->getMessage(),
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update user profile and photo
        try { 
            return [
                $request,
                $id
            ];
        } catch (\Exception $e) {
            return [
                $e->getMessage(),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, $reqDelete)
    {
        // Delete user profile photo 
        //  ** check status delete string(user,profile,photo)
        try {
            return response()->json([
                'id' => $id,
                'reqDelete' => $reqDelete
            ], 200);
        } catch (\Exception $e) {
            return [
                $e->getMessage(),
            ];
        }
    }
}
