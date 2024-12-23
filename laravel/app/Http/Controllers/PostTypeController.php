<?php

namespace App\Http\Controllers;

use App\Models\PostType;
use Illuminate\Http\Request;

class PostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => "api get post type success.",
            'post_types' => PostType::all()
        ], 200);
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
    public function show(PostType $postType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostType $postType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostType $postType)
    {
        //
    }
}
