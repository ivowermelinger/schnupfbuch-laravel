<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

trait HasVerificationMail
{
    public function adjustVerificationMail($user)
    {
     		// Customize the verification email
		VerifyEmail::toMailUsing(function ($user, string $url) {
			return (new MailMessage)
			->greeting(__('Hallo :name', ['name' =>$user->first_name]))
			->subject(__('E-Mail-Adresse bestätigen'))
			->line(__('Bitte klicke auf den folgenden Link, um deine E-Mail-Adresse zu bestätigen.'))
			->action(__('E-Mail-Adresse bestätigen'), $url)
			->line(__('Wenn du kein Konto erstellt hast, ignoriere diese E-Mail.'));
		});
    }
}
