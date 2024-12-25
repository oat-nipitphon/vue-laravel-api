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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
