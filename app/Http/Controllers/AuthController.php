<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
      /**
     * Handle an authentication attempt.
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        // Define validation rules
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];

        // Create a validator instance
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
                'success' => false
            ], 422);
        }

         // Get validated credentials
         $credentials = $validator->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'User authenticated',
                'success' => true
            ], 200);
        }

        // Send response with status code 401
        return response()->json([
            'message' => 'Unauthorized',
            'success' => false
        ], 401);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
