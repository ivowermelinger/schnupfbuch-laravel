<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Http\Controllers\Traits\HasVerificationMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
	use HasVerificationMail;

	/**
	 * Display the verify page.
	 */
	public function verify()
	{
		return view('verify');
	}

	public function verifyError(Request $request)
	{
		return Inertia::render('Auth/VerifyError', [
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

		if (!hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
			return redirect($this->getSignedErrorUrl())->with(['userToRefresh' => $user->id]);
		}

		// Mark the email as verified
		if (!$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
			$user->remember_token = Str::random(10);
			$user->save();
		} else {
			return redirect('/')->with(['flash' => [
				'message' => 'Ihre E-Mail-Adresse wurde bereits bestätigt.',
				'severity' => 'success',
			]]);
		}

		return Inertia::render('Auth/VerifySuccess', [
			'heading' => 'Registrierung erfolgreich - '.env('APP_NAME', ''),
		]);
	}

	public function resendMail(Request $request)
	{
		$id = $request->route('id');
		$user = User::find($id);

		if (!$user) {
			return redirect('register')->with(['flash' => [
				'message' => 'Dieser Benutzer wurde nicht gefunden! Bitte registrieren Sie sich erneut.',
				'severity' => 'error',
			]]);
		}

		$this->adjustVerificationMail($user);

		// Resend verification email
		$user->notify(new VerifyEmail());

		return redirect('/')->with(['flash' => [
			'message' => 'Die E-Mail wurde erneut versendet. Bitte überprüfen Sie Ihren Posteingang.',
			'severity' => 'success',
		]]);
	}

	private function getSignedErrorUrl()
	{
		return URL::temporarySignedRoute('verification.error', now()->addMinutes(5));
	}
}
