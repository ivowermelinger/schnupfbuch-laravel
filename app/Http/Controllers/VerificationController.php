<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Inertia\Inertia;

class VerificationController extends Controller
{
	/**
	 * Display the verify page.
	 */
	public function verify()
	{
		return view('verify');
	}

	public function verifyError(Request $request)
	{
		return Inertia::render('VerifyError', [
			'heading' => 'Aktivierungslink abgelaufen - '.env('APP_NAME', ''),
		]);
	}

	public function verifyEmail(Request $request)
	{
		$user = User::find($request->route('id'));

		if (!$user) {
			return redirect('register')->with(['flash' => [
				'message' => 'Dieser Benutzer wurde nicht gefunden! Bitte registrieren Sie sich erneut.',
				'severity' => 'error',
			]]);
		}

		return redirect($this->getSignedErrorUrl())->with(['userToRefresh' => $user->id]);
		if (!hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
			return redirect($this->getSignedErrorUrl($user->id));
		}

		// Mark the email as verified
		if (!$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
			$user->remember_token = Str::random(10);
			$user->save();
		}

		// Redirect to login page with a success message
		return redirect('/')->with('verified', true);
	}

	private function getSignedErrorUrl()
	{
		return URL::temporarySignedRoute('verification.error', now()->addMinutes(5));
	}
}
