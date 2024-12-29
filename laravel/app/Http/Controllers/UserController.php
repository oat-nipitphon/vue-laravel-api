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
            // Validate the incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'status' => 'nullable|string|max:50',
                'titleName' => 'nullable|string|max:50',
                'firstName' => 'nullable|string|max:50',
                'lastName' => 'nullable|string|max:50',
                'address' => 'nullable|string|max:255',
                'telPhone' => 'nullable|string|max:20',
                'birthDay' => 'nullable|date',
                'photo' => 'nullable|file|mimes:jpeg,png,jpg|max:10240', // Example for a photo field
            ]);
    
            // Retrieve the user
            $user = User::findOrFail($id);
    
            // Update user details
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->status = $validated['status'] ?? $user->status;
    
            // Update related UserProfile if provided
            if ($user->userProfiles) {
                $user->userProfiles->update([
                    'title_name' => $validated['titleName'] ?? $user->userProfiles->title_name,
                    'first_name' => $validated['firstName'] ?? $user->userProfiles->first_name,
                    'last_name' => $validated['lastName'] ?? $user->userProfiles->last_name,
                    'address' => $validated['address'] ?? $user->userProfiles->address,
                    'tel_phone' => $validated['telPhone'] ?? $user->userProfiles->tel_phone,
                    'birth_day' => $validated['birthDay'] ?? $user->userProfiles->birth_day,
                ]);
            }
    
            // Handle file upload for photo
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('user_photos', 'public');
                $user->userPhotos()->updateOrCreate(
                    ['user_id' => $user->id],
                    ['photo_path' => $photoPath]
                );
            }
    
            // Save the user
            $user->save();
    
            return response()->json([
                'status' => 200,
                'message' => 'User updated successfully.',
                'user' => $user,
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $validationError) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation Error',
                'errors' => $validationError->errors(),
            ], 422);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while updating the user.',
                'error' => $error->getMessage(),
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
