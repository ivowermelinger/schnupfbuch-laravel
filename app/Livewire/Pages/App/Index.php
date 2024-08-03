<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;
use App\Models\Line;
use App\Models\User;
use App\Models\UserInteraction;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Traits\HasAuthenticationMethods;

class Index extends Component
{
    use HasAuthenticationMethods;

    public $lines;
    public $limit = 25;
    public User $user;

    public function render()
    {
        return view('livewire.pages.app.index')->extends('layouts.app');
    }

    public function mount()
    {
		$this->getLines();
        $this->user = Auth::user();

    }

    public function getLines()
    {
        $userId = Auth::id();

        if ($userId) {
            $this->lines = Line::inRandomOrder()->limit($this->limit)
                ->where('lines.active', '=', 1)
                ->join('users', 'lines.user_id', '=', 'users.id')
                ->leftJoin('user_interactions', function ($join) use ($userId) {
                    $join->on('lines.id', '=', 'user_interactions.line_id')
                        ->where('user_interactions.user_id', '=', $userId)
                    ;
                })
                ->select('lines.*', 'users.nickname', 'user_interactions.liked', 'user_interactions.disliked')
                ->get()
            ;
        } else {
            $this->lines = Line::inRandomOrder()->limit($this->limit)
                ->where('lines.active', '=', 1)
                ->join('users', 'lines.user_id', '=', 'users.id')
                ->select('lines.*', 'users.nickname')
                ->get()
            ;
        }
    }

    public function refreshLines()
    {
        $this->getLines();

        $this->dispatch('linesUpdated', $this->lines);
    }

    public function like()
    {
        dd($this->line);
    }

    public function dislike()
    {
        dd($this->line);
    }
}
