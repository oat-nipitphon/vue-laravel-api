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

Route::get('/get_all_users', function () {

    $get_all_users = User::with('userProfiles', 'userPhotos')->get();

    return response()->json($get_all_users, 200);
    
});

Route::get('/user_profiles', function () {
    return response()->json([
        'user_profiles' => UserPhoto::all()
    ], 200);
});

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth:sanctum');

Route::get('/post_types', [PostTypeController::class, 'index'])->middleware('auth:sanctum');

Route::apiResource('/posts', PostController::class) ->middleware('auth:sanctum');

Route::post('/uploadFilePhoto', [UserProfileController::class, 'upload']);
Route::post('/upload_file_photo', [UserProfileController::class, 'uploadPhoto']);



