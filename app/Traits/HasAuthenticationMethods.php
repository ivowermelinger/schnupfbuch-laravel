<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasAuthenticationMethods
{
    public $email = '';
    public $password = '';
    public $remember = true;

    public function authenticate()
    {

        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));
            return;
        }

        return redirect()->intended(route('home'));
    }
}
