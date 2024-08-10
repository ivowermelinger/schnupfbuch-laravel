<?php

namespace App\Livewire\Pages\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\HasFlashMessage;


class Index extends Component
{
    use HasFlashMessage;
    public User $user;

    public $old_password;
    public $new_password;
    public $password_confirm;

    public function mount()
    {
        if (Auth::check()) {
            $this->user = Auth::user();
        }

        abort(404);
    }

    public function render()
    {
        return view('livewire.pages.settings.index')->extends('layouts.app');
    }

    public function changePassword()
    {

        $this->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8|same:password_confirm',
            'password_confirm' => 'required|min:8',
        ]);

        if (!Auth::attempt(['email' => $this->user->email, 'password' => $this->old_password])) {
            $this->addError('old_password', 'Altes Passwort ist nicht korrekt.');
            $this->new_password = '';
            $this->password_confirm = '';
            return;
        }

        if ($this->old_password === $this->new_password) {
            $this->addError('new_password', 'Das neue Passwort darf nicht mit dem alten Passwort identisch sein.');
            $this->new_password = '';
            $this->password_confirm = '';
            return;
        }

        $this->user->password = bcrypt($this->new_password);

        $this->user->save();

        $this->old_password = '';
        $this->new_password = '';
        $this->password_confirm = '';

        // Log out the user
        Auth::logout();

        $this->flash('success', 'Dein Passwort wurde erfolgreich geändert! Bitte melde dich erneut an.', 6000);

        return redirect()->route('login');
    }
}
