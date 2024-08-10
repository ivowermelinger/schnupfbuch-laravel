<?php

namespace App\Livewire\Pages\Admin;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Line;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public User $user;

    public ?Line $line;

    public $active;
    public $lines;

    public function mount()
    {

        if (Auth::check()) {
            $this->user = Auth::user();
        }

        if (isset($this->active)) {
            $this->lines = Line::all()->where('active', $request->active);
        } else {
            $this->lines = Line::all();
        }
    }

    public function render(Request $request)
    {
        $this->active = $request->active;


        return view('livewire.pages.admin.index')->extends('layouts.app');
    }

    public function toggleLineStatus($lineId)
    {
        $line = Line::find($lineId);
        $line->active = !$line->active;
        $line->save();
    }

    public function delete($lineId)
    {
        $line = Line::find($lineId);
        $line->delete();
    }
}
