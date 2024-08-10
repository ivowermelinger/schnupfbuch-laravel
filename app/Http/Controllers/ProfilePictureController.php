<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfilePictureController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $user->profile_seed = Str::random(32);
        $user->save();
        return redirect()->route('settings.index');
    }
}
