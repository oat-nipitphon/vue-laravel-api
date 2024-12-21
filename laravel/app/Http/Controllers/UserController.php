<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed', // ตรวจสอบว่า password กับ password_confirmation ตรงกัน
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        
        // ตรวจสอบผลการตรวจสอบข้อมูล
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),  // ข้อผิดพลาดจากการตรวจสอบ
                'status' => 422                    // รหัสสถานะ HTTP 422
            ], 422);  // ส่งข้อมูลกลับไปที่ผู้ใช้
        }

        try {

            // // Create the user with the validated data
            $user = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Hash the password
            ]);

            // Create the post associated with the user
            $post = Post::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'body' => $request->body,
            ]);

            // Check if user and post were successfully created
            if ($user && $post) {
                return response()->json([
                    'message' => 'Data inserted successfully.',
                    'status' => 201, // 201 Created
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Data insertion failed.',
                    'status' => 500, // 500 Internal Server Error
                ], 500);
            }
        } catch (\Exception $e) {
            // Handle any potential exceptions
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }
}
