<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
        /**
     * Display the view
     */
    public function show()
    {
        return Inertia::render('Register', [
            'heading' => 'Registrieren - ' . env('APP_NAME', ''),
        ]);
    }
}
