<?php

namespace App\Http\Controllers;

use App\Models\UserInteraction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserInteractionController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interactions = UserInteraction::all();
        return response()->json($interactions);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'line_id' => 'required|exists:lines,id',
            'liked' => 'required|boolean',
        ]);

        $interaction = new UserInteraction();
        $interaction->line_id = $request->line_id;
        $interaction->liked = $request->liked;
        $interaction->save();

        return response()->json($interaction, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserInteraction  $userInteraction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserInteraction $userInteraction)
    {
        $request->validate([
            'liked' => 'required|boolean',
        ]);

        $userInteraction->liked = $request->liked;
        $userInteraction->save();

        return response()->json($userInteraction, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserInteraction  $userInteraction
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserInteraction $userInteraction)
    {
        $userInteraction->delete();

        return response()->json(null, 204);
    }


    /**
     * Toggle the 'liked' attribute for a specific interaction.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggleLike($id, Request $request)
    {
        $request->validate([
            'liked' => 'required|boolean',
        ]);

        $userId = Auth::id();
        $userId = 1;
        $interaction = null;

        // Check if an interaction exists for the given line_id and user_id
        $existingInteraction = UserInteraction::where([
            'line_id' => $id,
            'user_id' => $userId
        ])->first();

        if ($existingInteraction) {
            // Update existing interaction
            $existingInteraction->update([
                'liked' => $request->liked,
            ]);

            $interaction = $existingInteraction;
        } else {
            // Create new interaction
            $newInteraction = UserInteraction::create([
                'line_id' => $id,
                'user_id' => $userId ?? 1,
                'liked' => $request->liked,
            ]);

            $interaction = $newInteraction;
        }

        return response()->json($interaction, 200);
    }
}
