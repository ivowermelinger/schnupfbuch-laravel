<?php

namespace App;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{

    public $user;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        if (Auth::check()) {
            $this->user = Auth::user();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.app.header');
    }
}
