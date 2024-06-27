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
        $lines = Line::inRandomOrder()->limit(10)
        ->join('authors', 'lines.author_id', '=', 'authors.id')
        ->select('lines.*', 'authors.nickname')
        ->get();
        return response($lines, 200);
    }

    public function show()
    {
        return view('app.index', [
            'heading' => env('APP_NAME', ''),
        ]);
    }
}
