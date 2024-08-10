<?php

namespace App\Livewire\Pages\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLines extends Component
{



    public function mount() {}


    public function render()
    {
        return view('livewire.pages.settings.user-lines')->extends('layouts.app');;
    }
}
