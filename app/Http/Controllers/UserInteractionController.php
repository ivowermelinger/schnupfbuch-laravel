<?php

namespace App\Http\Controllers;

use App\Models\UserInteraction;
use App\Models\Line;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
     * Toggle the 'liked' attribute for a specific interaction.
     *
     * @param  int  $line
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggleLike($line, Request $request)
    {

        $request->validate([
            'liked' => 'required|boolean',
            'disliked' => 'required|boolean',
        ]);

        $userId = Auth::id() ?? 1;

        // Find or create the UserInteraction record
        $interaction = UserInteraction::updateOrCreate(
            [
                'user_id' => $userId,
                'line_id' => $line,
            ],
            [
                'liked' => $request->liked,
                'disliked' => $request->disliked,
            ]
        );

        $lineModel = Line::find($line)->limit(1)
        ->join('users', 'lines.author_id', '=', 'users.id')
        ->leftJoin('user_interactions', function($join) use ($userId) {
            $join->on('lines.id', '=', 'user_interactions.line_id')
            ->where('user_interactions.user_id', '=', $userId);
        })
        ->select('lines.*', 'users.nickname', 'user_interactions.liked', 'user_interactions.disliked')
        ->get();

        return response()->json($lineModel, 200);
    }

    /**
     * Add a view for a specific interaction.
     *
     * @param  int  $line
     * @return \Illuminate\Http\Response
     */
    public function addView($line)
    {
        $userId = Auth::id();

        // Create new interaction
        $view = View::create([
            'line_id' => $line,
            'user_id' => $userId,
        ]);

        return response()->json($view, 200);
    }
}
