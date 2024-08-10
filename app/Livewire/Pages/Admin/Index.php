<?php

namespace App\Livewire\Pages\Admin;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Line;

class Index extends Component
{
    public ?Line $line;

    public $active;
    public $lines;

    public function mount()
    {
        if (isset($this->active)) {
            $this->lines = Line::all()->where('active', $request->active);
        } else {
            $this->lines = Line::all();
        }
    }

    public function render(Request $request)
    {
        $this->active = $request->active;


        return view('livewire.pages.line-management');
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
