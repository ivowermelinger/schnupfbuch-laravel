<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;

class ForgotPasswordController extends Controller
{
    public function show()
	{
		return Inertia::render('App/ForgotPassword', [
			'heading' => 'Passwort vergessen - '.env('APP_NAME', ''),
		]);
	}

	public function send(Request $request)
	{
		// Define validation rules
		$rules = [
			'email' => ['required', 'email'],
		];

		// Create a validator instance
		$validator = Validator::make($request->all(), $rules, [
			'email' => 'Bitte gib eine gültige E-Mail-Adresse ein',
		]);

		// Check if validation fails
		if ($validator->fails()) {
			return response()->json([
				'errors' => $validator->errors(),
				'success' => false,
			], 422);
		}

		$status = Password::sendResetLink(
			$request->only('email')
		);


		$message = Lang::get($status);

		if ($status !== Password::RESET_LINK_SENT) {
			return response()->json([
				'message' => $message,
				'success' => false,
			], 400);
		}

		return response()->json([
			'message' => $message,
			'success' => true,
		], 200);
	}
}
