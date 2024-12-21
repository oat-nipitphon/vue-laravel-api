<?php

namespace App\Http\Controllers;

use App\Models\PhotoPost;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePhotoPostRequest;
use App\Http\Requests\UpdatePhotoPostRequest;

class PhotoPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StorePhotoPostRequest $request)
    public function store(Request $request)
    {

        return response()->json([
            $request->input('formData')
        ]);

        $request->validate([
            // 'user_id' => 'required',
            'postImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $imageName = time() . '.' . $request->file('postImg')->extension();
        $request->file('postImg')->move(public_path('images'), $imageName);
    
        $photoPost = PhotoPost::create([
            'name' => $imageName,
            'status' => 200,
        ]);
    
        return response()->json([
            'status' => 200,
            'photoPost' => $photoPost,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PhotoPost $photoPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoPostRequest $request, PhotoPost $photoPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhotoPost $photoPost)
    {
        //
    }
}
