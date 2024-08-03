<?php

namespace App\Livewire\Pages\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Index extends Component
{
    public User $user;

    public function mount()
    {
        if (Auth::check()) {
            $this->user = Auth::user();
        }
    }

    public function render()
    {
        return view('livewire.pages.settings.index')->extends('layouts.app');
    }
}
