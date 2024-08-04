<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Traits\HasAuthenticationMethods;

class Login extends Component
{
    use HasAuthenticationMethods;

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
