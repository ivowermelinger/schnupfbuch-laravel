<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Line;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class App extends Component
{
    public $list;
    public $clicked = -1;

    public $line = '';
    public $title = '';

    public function getLine()
    {
        if ($this->list instanceof Collection && $this->clicked >= 0 && $this->clicked < $this->list->count()) {
            $this->line = $this->list[$this->clicked];
            $this->clicked++;
        } else {
            $this->getList();
        }
    }

    private function getList()
    {
        $this->list = Line::inRandomOrder()->limit(10)->get();
        $this->clicked = 0;

    }


    public function mount() {
        $this->title = env('APP_NAME', '');
        $this->getList();
        $this->getLine();
    }

    public function render()
    {
        Log::debug('Render is called.... is called. List fetched.');
        return view('livewire.app')
            ->layout('components/layouts.app', ['title' => $this->title]);
    }
}
