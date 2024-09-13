<?php

namespace App\Livewire\Pages\Settings;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class UserLines extends Component
{
	public function mount() {}

	public function render()
	{
		return view('livewire.pages.settings.user-lines');
	}
}
