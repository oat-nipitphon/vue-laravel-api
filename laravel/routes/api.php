<?php

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PhotoPostController;
use App\Http\Controllers\UserController;
use App\Models\PostType;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function () {
    return response()->json(User::all(), 200);
});

Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth:sanctum');

Route::get('/post_types', function () {
    return response()->json([
        'status' => 200,
        'message' => "api get post type success.",
        'post_types' => PostType::all()
    ], 200);
});

Route::apiResource('/posts', PostController::class)
    ->middleware('auth:sanctum');

Route::post('/upload_photo', [PostController::class, 'uploadPhoto']);

Route::post('/photo_post/store', [PhotoPostController::class, 'store']);

// Route::get('/user_post_map', function () {
//       // Get users along with their posts
//       $data = User::with('posts')->get();

//       // Transform the data to include only the user and the body of their posts
//       $result = $data->map(function ($user) {
//           return [
//               'id' => $user->id,
//               'name' => $user->name,
//               'email' => $user->email,
//               'posts' => $user->posts->map(function ($post) {
//                   return [
//                       'id' => $post->id,
//                       'title' => $post->title,
//                       'body' => $post->body,  // Only return the 'body' of each post
//                   ];
//               }),
//           ];
//       });
  
//       // Return the transformed data as a JSON response
//       return response()->json(['data' => $result], 200);
// });

