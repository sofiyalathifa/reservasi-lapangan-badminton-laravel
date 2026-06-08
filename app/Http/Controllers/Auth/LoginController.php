<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $role = strtolower(Auth::user()->role);
            if ($role === 'owner') {
                return redirect()->route('owner.dashboard')->with('success', 'Berhasil login ke Dashboard Owner!');
            } elseif (in_array($role, ['admin', 'kasir'])) {
                return redirect()->route('dashboard')->with('success', 'Berhasil login ke Dashboard!');
            }

            return redirect()->intended(route('home'))->with('success', 'Berhasil login!');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $role = Auth::check() ? Auth::user()->role : null;
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $role = $role ? strtolower($role) : null;
        if (in_array($role, ['admin', 'kasir', 'owner'])) {
            return redirect()->route('login')->with('success', 'Berhasil logout.');
        }

        return redirect('/');
    }
}
