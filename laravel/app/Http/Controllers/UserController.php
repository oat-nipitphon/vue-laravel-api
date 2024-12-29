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
        try {
            $user_show = User::findOrFail($id);
            
            if($user_show){
                $user_show = User::with('userProfiles', 'userPhotos')->where('id', $id)->first();
                return response()->json([
                    'status' => 200,
                    'user' => $user_show
                ], 200);
                // dd($user_show);
            } else {
                dd($user_show);
            }
        } catch (\Exception $error) {
            return response()->json([
                'message' => "laravel function error :",
                'error' => $error->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            dd($request);
            
        } catch (\Exception $error) {
            return response()->json([
                'status' => 500,
                'error' => $error->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
