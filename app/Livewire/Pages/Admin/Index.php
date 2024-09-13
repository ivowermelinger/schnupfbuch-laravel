<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Line;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
	public ?Line $line;

	public $lines;

	public $filter = 'active';
	public $query;

	public $includeTrashed = true;

	public function mount()
	{
		$this->loadLines();
	}

	public function render(Request $request)
	{
		return view('livewire.pages.admin.index');
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
		dd($line);
		if ($line->trashed()) {
			$line->restore();
		} else {
			$line->update(['active' => false]);
			$line->delete();
		}

		$this->loadLines();
	}

	public function forceRemove($lineId)
	{
		$line = Line::withTrashed()->find($lineId);
		$line->forceDelete();
		$this->loadLines();
	}

	public function loadLines()
	{
		if ($this->query) {
			$query = Line::search($this->query)->query(function ($query) {
				// Perform the join with the users table
				$query->join('users', 'lines.user_id', '=', 'users.id')
					->select('lines.*', 'users.first_name', 'users.last_name')
					->orderBy('lines.id', 'desc')
				;
			});
		} else {
			$query = Line::query();
		}

		// Include soft deleted records if the flag is set
		if ($this->includeTrashed) {
			$query->withTrashed();
		}

		// Apply the active filter
		$query->where('active', 'active' === $this->filter);

		// Eager load the user relationship
		$this->lines = $query->get();
	}
}
