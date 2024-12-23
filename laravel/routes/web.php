<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

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

require __DIR__.'/auth.php';
