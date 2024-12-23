<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPhoto;
// use App\Models\Article;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{

    public function uploadPhoto (Request $request) {

        $inputReq = $request->input("file_photo");
        
        return response()->json([
            'status' => 200,
            'request' => $inputReq
        ], 200);

    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            // File is present
            $fileName = time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads'), $fileName);
    
            // Save the file path in the database
            // File::create(['path' => $fileName]);
    
            return response()->json(['success' => 'File uploaded successfully.']);
        } else {
            return response()->json(['error' => 'No file uploaded.'], 422);
        }
    }
    

    public function testUploadPhoto (Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000', // Validate image field
            'title' => 'required|string|max:255', // Add validation for 'title' if it's expected
        ]);
    
        $file = $request->file('image');
    
        // Check if file exists before proceeding
        if (!$file) {
            return response()->json(['error' => 'File upload error: No file received.'], 400);
        }
    
        $image_name = time() . '_image_' . $file->getClientOriginalName();
        $file->move('public/storage/photo_users', $image_name);
        $data = $request->all();
        $data['image'] = 'public/storage/photo_users/' . $image_name;
        $data['slug'] = Str::slug($request->title);
    
        $article = UserPhoto::create($data);
        return response()->json($article);
    }

    public function uploadUserPhoto (Request $request) {
        
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'user_photo' => 'required',
            'userPhotoURL' => 'required',
        ]);

        return response()->json([
            'status' => 200,
            'data' => $request->all()
        ]);

    }

    public function uploadImg(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id', // Ensure the user exists
                'user_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
                'user_img_url' => 'required|max:255',
            ]);

            // Fetch the user
            $user = User::find($validatedData['user_id']);

            dd($user);

            if (!$user) {
                return response()->json([
                    'message' => "User not found.",
                    'status' => 404,
                ], 404);
            }

            // Check if the request has a file
            if ($request->hasFile('user_img')) {
                $userPhoto = $request->file('user_img');
                $filePath = $userPhoto->store('photo_users', 'public');
                $fileBinary = file_get_contents($userPhoto->getRealPath());

                // Update or create user photo data
                $userPhotoData = UserPhoto::create([
                    'user_id' => $user->id,
                    'photo_path' => $filePath,
                    'photo_name' => $userPhoto,
                    'photo_data' => $fileBinary,
                ]);

                return response()->json([
                    'message' => "Image uploaded successfully.",
                    'data' => $userPhotoData,
                ], 201);
            } else {
                return response()->json([
                    'message' => "No image file provided.",
                    'status' => 400,
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => "An error occurred: " . $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
