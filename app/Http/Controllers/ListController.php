<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Line;
use App\Models\UserInteraction;

class ListController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $userId = 1;

        $lines = Line::inRandomOrder()->limit(10)
        ->join('users', 'lines.author_id', '=', 'users.id')
        ->leftJoin('user_interactions', function($join) use ($userId) {
            $join->on('lines.id', '=', 'user_interactions.line_id')
            ->where('user_interactions.user_id', '=', $userId);
        })
        ->select('lines.*', 'users.nickname', 'user_interactions.liked', 'user_interactions.disliked')
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
