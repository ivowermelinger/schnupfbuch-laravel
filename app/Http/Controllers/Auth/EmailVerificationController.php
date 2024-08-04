<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HasFlashMessage;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Access\AuthorizationException;

class EmailVerificationController extends Controller
{
    use HasFlashMessage;

    public function __invoke(string $id, string $hash): RedirectResponse
    {

        // Get user from id
        $user = User::find($id);

        if (!$user) {
            throw new AuthorizationException();
        }

        // Login user
        Auth::login($user);

        if (!hash_equals((string) $id, (string) Auth::user()->getKey())) {
            throw new AuthorizationException();
        }

        if (!hash_equals((string) $hash, sha1(Auth::user()->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        if (Auth::user()->hasVerifiedEmail()) {
            $this->flash('success', __('Deine E-Mail-Adresse wurde bereits bestätigt.'));
            return redirect(route('login'));
        }

        if (Auth::user()->markEmailAsVerified()) {
            event(new Verified(Auth::user()));
        }

        $this->flash('success', __('Deine E-Mail-Adresse wurde erfolgreich bestätigt.'));
        return redirect(route('home'));
    }
}
