<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{

	public function show(Request $request)
	{
		$token = $request->token;

		return Inertia::render('App/ResetPassword', [
			'heading' => 'Passwort zurücksetzen - '.env('APP_NAME', ''),
			'token' => $token,
			'email' => $request->email,
		]);
	}

	public function reset(Request $request)
	{
		// Define validation rules
		$rules = [
			'password' => ['required', 'confirmed', 'min:8'],
			'password_confirmation' => ['required', 'same:password', 'min:8'],
		];

		// Create a validator instance
		$validator = Validator::make($request->all(), $rules, [
			'password.required' => 'Bitte gib dein Passwort ein',
			'password.confirmed' => 'Passwörter stimmen nicht überein',
			'password.min' => 'Passwort muss mindestens 8 Zeichen lang sein',
			'required' => 'Dieses Feld wird benötigt',
			'same' => 'Passwörter stimmen nicht überein',
		]);

		// Check if validation fails
		if ($validator->fails()) {
			return response()->json([
				'errors' => $validator->errors(),
				'success' => false,
			], 422);
		}

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),

			function (User $user, string $password) {
				$user->forceFill([
					'password' => Hash::make($password)
				])->setRememberToken(Str::random(12));

				$user->save();

				event(new PasswordReset($user));
			}
		);

		$message = Lang::get($status);

		if ($status !== Password::PASSWORD_RESET) {
			return response()->json([
				'message' => $message,
				'success' => false,
			], 400);
		} else {
			return response()->json([
				'message' => $message,
				'success' => true,
			], 200);
		}
	}
}
