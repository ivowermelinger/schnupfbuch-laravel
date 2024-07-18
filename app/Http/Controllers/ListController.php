<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ListController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$userId = Auth::id();

		if ($userId) {
			$lines = Line::inRandomOrder()->limit(10)
				->where('lines.active', '=', 1)
				->join('users', 'lines.author_id', '=', 'users.id')
				->leftJoin('user_interactions', function ($join) use ($userId) {
					$join->on('lines.id', '=', 'user_interactions.line_id')
						->where('user_interactions.user_id', '=', $userId)
					;
				})
				->select('lines.*', 'users.nickname', 'user_interactions.liked', 'user_interactions.disliked')
				->get()
			;
		} else {
			$lines = Line::inRandomOrder()->limit(10)
				->where('lines.active', '=', 1)
				->join('users', 'lines.author_id', '=', 'users.id')
				->select('lines.*', 'users.nickname')
				->get()
			;
		}

		return response($lines, 200);
	}

	/**
	 * Display the view.
	 */
	public function show()
	{
		return Inertia::render('App', [
			'heading' => env('APP_NAME', ''),
		]);
	}
}
