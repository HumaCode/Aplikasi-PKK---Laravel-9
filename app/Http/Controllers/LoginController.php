<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect()->intended('home');
        }

        return view('login.v_login');
    }

    public function proses(Request $request)
    {
        // validasi
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username tidak boleh kosong..!',
                'password.required' => 'Password tidak boleh kosong..!'
            ]
        );

        // memastikan password dan username benar
        $kredensial = $request->only('username', 'password');
        if (Auth::attempt($kredensial)) {
            $user = Auth::user();

            if ($user = Auth::user()) {

                $request->session()->regenerate();

                if ($user) {
                    return redirect()->intended('home');
                }

                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'username' => 'Username atau Password salah.!!',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
