<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('index.index', [
        'heading' => env('APP_NAME', '')
    ]);
});