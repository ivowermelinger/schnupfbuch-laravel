<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LineController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		// Define validation rules
		$rules = [
			'nickname' => ['required', 'string', 'max:255'],
			'line' => ['required', 'string', 'max:255'],
			'email' => ['required', 'email'],
			'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
		];

		// Create a validator instance
		$validator = Validator::make($request->all(), $rules);

		// Check if validation fails
		if ($validator->fails()) {
			return response()->json([
				'message' => 'Validation Error',
				'errors' => $validator->errors(),
				'success' => false,
			], 422);
		}

		// Check if a user exists with the provided email
		$user = User::where('email', $request->email)->first();

		// If no user exists, create a new user
		if (!$user) {
			$user = User::create([
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'nickname' => $request->nickname,
				'email' => $request->email,
				'active' => true,
			]);
		}

		// Create a new line
		$line = Line::create([
			'line' => $request->line,
			'author_id' => $user->id,
		]);

		return response()->json([
			'message' => 'Spruch wurde erfolgreich erstellt. Sobald er freigegeben wurde, wird er angezeigt.',
			'data' => $line,
			'success' => true,
		], 201);
	}
}
