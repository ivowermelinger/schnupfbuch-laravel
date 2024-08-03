<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Livewire\Traits\HasAuthenticationMethods;

class Login extends Component
{
    use HasAuthenticationMethods;

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
