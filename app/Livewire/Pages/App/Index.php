<?php

namespace App\Livewire\Pages\App;

use Livewire\Component;
use App\Models\Line;
use App\Models\User;
use App\Models\View;
use App\Models\UserInteraction;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Traits\HasAuthenticationMethods;

class Index extends Component
{
    use HasAuthenticationMethods;

    public $lines;
    public $limit = 25;
    public User $user;

    public function mount()
    {
        $this->getLines();

        if (Auth::check()) {
            $this->user = Auth::user();
        }
    }

    public function refreshLines()
    {
        $this->getLines();

        $this->dispatch('allLinesUpdated', $this->lines);
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
                        ->where('user_interactions.user_id', '=', $userId);
                })
                ->select('lines.*', 'users.nickname', 'user_interactions.liked', 'user_interactions.disliked')
                ->get();
        } else {
            $this->lines = Line::inRandomOrder()->limit($this->limit)
                ->where('lines.active', '=', 1)
                ->join('users', 'lines.user_id', '=', 'users.id')
                ->select('lines.*', 'users.nickname')
                ->get();
        }
    }

    public function addView($line)
    {
        $userId = Auth::id();

        if (!$userId) {
            return;
        }

        // Create new interaction
        $view = View::firstOrCreate([
            'line_id' => $line,
            'user_id' => $userId,
        ]);

        $view->increment('views');
    }


    public function toggleLike($liked, $disliked, $line)
    {
        // Validate inputs
        if (!is_bool($liked) || !is_bool($disliked)) {
            throw new \InvalidArgumentException('Liked and disliked must be boolean');
        }

        $userId = Auth::id();

        // Find or create the UserInteraction record
        $interaction = UserInteraction::updateOrCreate(
            [
                'user_id' => $userId,
                'line_id' => $line,
            ],
            [
                'liked' => $liked,
                'disliked' => $disliked,
            ]
        );

        // Remove the interaction if both liked and disliked are false
        if (!$liked && !$disliked) {
            $interaction->delete();
        }

        $newLine = Line::where('lines.id', $line)
            ->join('users', 'lines.user_id', '=', 'users.id')
            ->leftJoin('user_interactions', function ($join) use ($userId) {
                $join->on('lines.id', '=', 'user_interactions.line_id')
                    ->where('user_interactions.user_id', '=', $userId);
            })
            ->select('lines.*', 'users.nickname', 'user_interactions.liked', 'user_interactions.disliked')
            ->first();

        $this->dispatch('singleLineUpdated', $newLine);
    }


    public function render()
    {
        return view('livewire.pages.app.index')->extends('layouts.app');
    }
}
