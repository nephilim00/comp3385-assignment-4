<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    //


    // In your MovieController

public function index()
{
    $movies = Movie::all(); // Assuming you have a Movie model
    return response()->json($movies);
}

    

public function store(Request $request)
{
    // Validate user input
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            "message" => "Validation errors",
            "errors" => $validator->errors()
        ], 422);
    }

    // Handle file upload
    $path = $request->file('poster')->store('public/posters');
    $publicPath = Storage::url($path); // Get the public URL of the file

    // Create new movie record
    $movie = new Movie;
    $movie->title = $request->title;
    $movie->description = $request->description;
    $movie->poster = $publicPath;
    $movie->save();

    // Return success response
    return response()->json([
        "message" => "Movie created successfully",
        "movie" => $movie
    ]);
}


}
