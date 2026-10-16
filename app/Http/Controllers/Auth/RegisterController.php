<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    /**
     * Show the application registration form (disabled - redirects to login).
     */
    public function showRegistrationForm(): RedirectResponse
    {
        return redirect()->route('login');
    }

    /**
     * Handle a registration request for the application (disabled - aborts 403).
     */
    public function register(): never
    {
        abort(403, 'Public registration is disabled. Only administrators can create new users.');
    }
}
