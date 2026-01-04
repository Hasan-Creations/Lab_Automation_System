<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // show login box
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // try to log in
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

                // simple direct redirect
                if ($user->user_type == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.dashboard');
                }
            }

            // normal hash check
            if (\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $request->session()->regenerate();

                // simple direct redirect
                if ($user->user_type == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.dashboard');
                }
            }
        }

        return back()->withErrors([
            'username' => 'wrong username or password.',
        ]);
    }

    // get out
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
