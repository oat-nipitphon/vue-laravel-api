<?php

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PhotoPostController;
use App\Http\Controllers\PostTypeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Models\PostType;
use App\Models\UserProfile;
use App\Models\UserPhoto;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth:sanctum');

Route::apiResource('/users', UserController::class);
// ->middleware('auth:sanctum');
Route::get('/userProfilePhoto', function () {

    $userProfilePhoto = User::with('userProfiles', 'userPhotos', 'posts')->get();

    return response()->json([
        'message' => "Get full data user profile photo and photo !!",
        'req' => $userProfilePhoto
    ], 200);
    
});

Route::apiResource('/posts', PostController::class)->middleware('auth:sanctum');
Route::get('/post_types', [PostTypeController::class, 'index'])->middleware('auth:sanctum');

// Route API Success insert file name and move file folder pubilc laravel
Route::post('/uploadFilePhoto', [UserProfileController::class, 'upload']);



// **********************  TEST ROUTE API **************************** //

Route::get('/get_users', function () {
    return response()->json([
        'users' => User::all()
    ], 200);
});

Route::get('/get_user_profiles', function () {
    return response()->json([
        'user_profiles' => UserProfile::all()
    ], 200);
});



Route::post('/upload_file_photo', [UserProfileController::class, 'uploadPhoto']);



