<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.app.index')->extends('layouts.app');
    }
}
