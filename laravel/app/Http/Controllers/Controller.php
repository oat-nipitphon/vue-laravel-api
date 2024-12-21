<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;  // Correct namespace for Request class


abstract class Controller
{
    public function save (Request $request) {
        $data = $request->all();
        return response()->json([
            'data' => $data,
            'status' => 200
        ], 200);
    }
}
