<?php

namespace App\Livewire\Auth;


use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Illuminate\Support\Facades\App;

class Register extends Component
{
    public $email = 'email@email.com';
    public $password = 'password';
    public $password_confirmation = 'password';
    public $first_name = 'Maxi';
    public $last_name = 'Muster';
    public $nickname = 'Maxi';

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
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));
        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
