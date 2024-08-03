<?php

namespace App\Livewire\Components\App;

use App\Models\Line;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Footer extends Component
{

    public $line = 'Ist der Hund im Zwinger am knurren, gehe ich lieber aussen durren!';

    public function render()
    {
        return view('livewire.components.app.footer');
    }

    public function store()
    {
        $this->validate([
            'line' => 'required',
        ]);

        $line = new Line;
        $line->line = $this->line;
        $line->user_id = Auth::id();
        $line->save();

        $this->line = '';

        session()->flash('message', [
            'success' => true,
            'text' => 'Dein Spruch wurde erfolgreich gespeichert! Sobald er geprüft wurde, wird er angezeigt. Danke!',
        ]);

        return redirect()->intended(route('home'));
    }
}
