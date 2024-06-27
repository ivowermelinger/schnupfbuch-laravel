<?php

namespace App\Http\Controllers;

use App\Models\Line;
use Illuminate\Http\Request;

class ListController extends Controller
{

        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Line::inRandomOrder()->limit(10)->get(), 200);
    }

    public function show()
    {
        return view('app.index', [
            'heading' => env('APP_NAME', ''),
        ]);
    }
}
