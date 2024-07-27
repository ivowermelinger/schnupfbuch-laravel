<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    protected $resetUrl;

    /**
     * Create a new notification instance.
     *
     * @param  string  $resetUrl
     * @return void
     */
    public function __construct($resetUrl)
    {
        $this->resetUrl = $resetUrl;
    }

    /**
     * Get the channels the notification should be sent on.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // Send via email
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Set german locale
        app()->setLocale('de');

        $expires = config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60);
        $firstName = $notifiable->first_name;

        return (new MailMessage)
            ->greeting('Hallo ' .  $firstName)
            ->subject('Passwort zurücksetzen')
            ->action('Passwort zurücksetzen', $this->resetUrl)
            ->line(__('passwords.reset_expiration', ['count' => $expires]))
            ->line('Wenn du keine E-Mail zum Zürcksetzen des Passworts angefordert hast, musst du nichts weiter tun.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            // Additional data can be added here if needed
        ];
    }
}
