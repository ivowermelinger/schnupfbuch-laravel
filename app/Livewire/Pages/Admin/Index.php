<?php

namespace App\Livewire\Pages\Admin;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Line;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public ?Line $line;

    public $lines;

    public $filterActive = false;
    public $includeTrashed = true;

    public function mount()
    {
        $this->loadLines();
    }

    public function render(Request $request)
    {
        return view('livewire.pages.admin.index')->extends('layouts.app');
    }

    public function toggleLineActive(Line $line)
    {
        $line->active = !$line->active;
        $line->save();

        // Reload lines after toggling the active state
        $this->loadLines();
    }

    public function remove(Line $line)
    {
        $line->delete();

        // Reload lines after deletion
        $this->loadLines();
    }

    public function revert() {}

    public function toggleFilter()
    {
        $this->filterActive = !$this->filterActive;
        $this->loadLines();
    }

    private function loadLines()
    {
        $query = Line::query();

        // Include soft deleted records if the flag is set
        if ($this->includeTrashed) {
            $query->withTrashed();
        }

        // Apply the active filter
        $query->where('active', $this->filterActive);

        // Eager load the user relationship
        $this->lines = $query->with('user')->get();
    }
}
