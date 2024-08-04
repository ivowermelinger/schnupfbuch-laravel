<?php

namespace App\Traits;

trait HasFlashMessage
{
    public function flash($success, $message, $duration = 3000)
    {
        session()->flash('message', collect([
            'success' => $success,
            'text' => $message,
            'duration' => $duration,
        ]));
    }
}
