<?php

namespace App\Livewire\Auth;


use App\Models\User;
use App\Traits\HasFlashMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Illuminate\Support\Facades\App;

class Register extends Component
{
    use HasFlashMessage;

    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $first_name = '';
    public $last_name = '';
    public $nickname = '';

    public function register()
    {
        $this->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:password_confirmation'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'nickname' => ['required', 'min:4', 'unique:users'],
        ]);

        $user = User::create([
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'nickname' => $this->nickname,
            'profile_seed' => $this->nickname,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        $this->flash('success', __('Dein Account wurde erstellt. Du hast eine E-Mail erhalten, um deine E-Mail-Adresse zu bestätigen.'));

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
