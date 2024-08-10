<?php

namespace App\Livewire\Components\App;

use App\Models\Line;
use App\Traits\HasFlashMessage;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Footer extends Component
{
    use HasFlashMessage;

    public $line = '';

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

        $this->flash('success', 'Dein Spruch wurde erfolgreich gespeichert. Sobald er freigegeben wurde, wird er angezeigt.', 6000);

        return redirect()->intended(route('home'));
    }
}
