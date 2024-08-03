<?php

namespace App\Livewire\Pages\Admin;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Line;

class Index extends Component
{
    public ?Line $line;


    public $active;

    public function render(Request $request)
    {
       $this->active = $request->active;

        if (isset($this->active)) {
            $lines = Line::all()->where('active', $request->active);
        }else{
            $lines = Line::all();
        }
        return view('livewire.pages.line-management')->with([
            'lines' => $lines,
        ]);
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
