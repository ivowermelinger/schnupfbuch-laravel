<?php

namespace App\Livewire\Components\App;

use Livewire\Component;

class Footer extends Component
{

    public $line;

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
        $this->getLines();
    }
}
