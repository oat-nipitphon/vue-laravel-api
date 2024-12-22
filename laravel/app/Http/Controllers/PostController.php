<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\PhotoPost;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
  
    {
        return response()->json([
            'posts' => Post::with('user')->orderBy('created_at', 'desc')->get(),
            'message' => 'get user and post success',
            'status' => 200
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        try {
            // $get_post = Post::with('user', 'photoPost')->where('id', $post->id)->latest()->first();
            
            // dd($get_post);

            return response()->json([
                'post' => $post,
                'user' => $post->user
            ], 200);

    
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Error fetching posts by the user",
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StorePostRequest $request)
    public function store(Request $request)
    {

        // return $request;
        try {
            // Validate incoming request data
            $fields = $request->validate([
                'user_id' => 'required', // Ensure the user exists
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'postType' => 'required|string',
                'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // Handle file validation
            ]);
    
            // Find the user (throws 404 if user not found)
            // $user = User::findOrFail($fields['user_id']);


            // Create the post
            $post = Post::create([
                'user_id' => $fields['user_id'],
                'title' => $fields['title'],
                'content' => $fields['content'],
                'type' => $fields['postType'],
            ]);
    
            // Handle file upload if present
            // if ($request->hasFile('photo')) {
            //     $photo = $request->file('photo');
            //     $photoPath = $photo->store('posts', 'public'); // Store file in the 'public' disk under 'posts' folder
    
            //     // Optionally, associate the photo with the post (if you have a PhotoPost model)
            //     $post->photoPosts()->create([
            //         'photo_name' => $photo->getClientOriginalName(),
            //         'photo_path' => $photoPath,
            //         'photo_data' => file_get_contents($photo->getRealPath()),
            //     ]);
            // }
    
            // Return a successful response with the post details
            return response()->json([
                'status' => 201,
                'message' => 'Post created successfully',
                'post' => $post,
            ], 201);
    
        } catch (\Exception $error) {
            // Return error response
            return response()->json([
                'error' => 'Error creating post: ' . $error->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdatePostRequest $request, Post $post)
    public function update(Request $request, $id)
    {
        try {
            // Validate incoming data
            $fields = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'postType' => 'required|string',
            ]);
    
            // Find the post by ID
            $post = Post::find($id);
    
            // If the post does not exist, return a 404 error
            if (!$post) {
                return response()->json([
                    'message' => 'Post not found',
                ], 404);
            }
    
            // Update the post with validated data
            $post->update([
                'title' => $fields['title'],
                'content' => $fields['content'],
                'type' => $fields['postType']
            ]);
    
            // Return the updated post in the response
            return response()->json([
                'status' => 200,
                'message' => 'Post updated successfully',
                'post' => $post,
            ], 200);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions
            return response()->json([
                'message' => 'Validation error: ' . $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                'message' => 'An error occurred while updating the post: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post = $post->delete();
            return [
                'message' => "Delete Post Success.",
                'status' => 200
            ];
        } catch (\Exception $e) {
            return [
                'message' => "Error function destroy delete post",
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
}
