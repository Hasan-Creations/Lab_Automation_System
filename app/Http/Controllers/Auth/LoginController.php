<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Centralized redirection logic based on user roles
     */
    protected function redirectUser($user)
    {
        if ($user->user_type == 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        // If already authenticated, skip login and go to dashboard
        if (Auth::check()) {
            return $this->redirectUser(Auth::user());
        }
        return view('auth.login');
    }

    /**
     * Handle login attempt
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('username', $request->username)->first();

        if ($user) {
            // check legacy plain text password
            if ($user->password === $request->password) {
                // fix it to use hash now
                $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
                $user->save();

                Auth::login($user);
                $request->session()->regenerate();

                return $this->redirectUser($user);
            }

            // normal hash check
            if (\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $request->session()->regenerate();

                return $this->redirectUser($user);
            }
        }

        return back()->withErrors([
            'username' => 'Wrong username or password.',
        ]);
    }

    /**
     * Log out
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Redirect to home page instead of login
        return redirect()->route('home');
    }
}
