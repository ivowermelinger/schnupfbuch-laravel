<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Lang;
use Inertia\Inertia;

class AuthController extends Controller
{

	public function show()
	{
		return Inertia::render('App/LoginPage', [
			'heading' => 'Login - '.env('APP_NAME', ''),
		]);
	}

	/**
	 * Handle an authentication attempt.
	 *
	 * @return Response
	 */
	public function authenticate(Request $request)
	{
		// Define validation rules
		$rules = [
			'email' => ['required', 'email'],
			'password' => ['required'],
		];

		// Create a validator instance
		$validator = Validator::make($request->all(), $rules, [
			'email' => 'Bitte gib eine gültige E-Mail-Adresse ein',
			'password.required' => 'Bitte gib dein Passwort ein',
		]);

		// Check if validation fails
		if ($validator->fails()) {
			return response()->json([
				'message' => 'Bitte überprüfe deine Eingaben',
				'errors' => $validator->errors(),
				'success' => false,
			], 422);
		}

		// Check if has no account
		$user = User::where('email', $request->email)->first();

		// Check if user exists
		if (!$user) {
			return response()->json([
				'message' => 'Benutzername oder Passwort falsch. Bitte versuchen Sie es erneut.',
				'success' => false,
			], 401);
		}

		// Check if email is verified
		if (!$user->hasVerifiedEmail()) {
			return response()->json([
				'message' => 'Bitte bestätigen Sie Ihre E-Mail-Adresse, um sich einloggen zu können.',
				'success' => false,
			], 401);
		}

		// Define validation rules
		$rules = [
			'email' => ['required', 'email'],
			'password' => ['required'],
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

		// Get validated credentials
		$credentials = $validator->validated();

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			return response()->json([
				'message' => 'User authenticated',
				'success' => true,
			], 200);
		}

		// Send response with status code 401
		return response()->json([
			'message' => 'Benutzername oder Passwort falsch. Bitte versuchen Sie es erneut.',
			'success' => false,
		], 401);
	}

	public function forgot()
	{
		return Inertia::render('App/ForgotPassword', [
			'heading' => 'Passwort vergessen - '.env('APP_NAME', ''),
		]);
	}

	public function forgotSend(Request $request)
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

	/**
	 * Log the user out of the application.
	 */
	public function logout(Request $request): RedirectResponse
	{
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect('/');
	}
}
