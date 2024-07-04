<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Line;
use Illuminate\Http\Request;

class ListController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lines = Line::inRandomOrder()->limit(10)
        ->join('users', 'lines.author_id', '=', 'users.id')
        ->select('lines.*', 'users.nickname')
        ->get();
        return response($lines, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validate form inputs
         $fields = $request->validate([
            'line',
            'views',
            'likes',
        ]);

        // Find the listing by ID
        $listing = Listing::findOrFail($id);

        // Update the listing with validated data
        $listing->update($validatedData);

        // Optionally, return a response indicating success
        return response()->json(['message' => 'Listing updated successfully', 'data' => $listing], 200);
    }



    /**
     * Display the view
     */
    public function show()
    {
        return Inertia::render('App', [
            'heading' => env('APP_NAME', ''),
        ]);
    }
}
