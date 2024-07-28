<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LineController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		// Define validation rules
		$rules = [
			'line' => ['required', 'string', 'max:255'],
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

		$userId = Auth::id();

		// Create a new line
		$line = Line::create([
			'line' => $request->line,
			'user_id' => $userId,
		]);

		return response()->json([
			'message' => 'Spruch wurde erfolgreich erstellt. Sobald er freigegeben wurde, wird er angezeigt.',
			'data' => $line,
			'success' => true,
		], 201);
	}
}
