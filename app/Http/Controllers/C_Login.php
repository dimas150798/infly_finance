<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_Login extends Controller
{
    function index()
    {
        $title = 'Finance | Login';
        return view('V_Login', compact('title'));
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'email'     => 'required',
                'password'  => 'required'
            ],
            [
                'email.required'    => 'Email Wajib Diisi',
                'password.required' => 'Password Wajib Diisi'
            ]
        );

        $DataLogin = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if (Auth::attempt($DataLogin)) {
            // Authentication successful
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('alert-success', 'Login Berhasil');
            } elseif (Auth::user()->role == 'superadmin') {
                return redirect()->route('superadmin.dashboard')->with('alert-info', 'Selamat datang, Superadmin! Fitur Belum Ada');
            } else {
                return redirect()->route('user.dashboard')->with('alert-info', 'Selamat datang, Pengguna! Fitur Belum Ada');
            }
        } else {
            // Authentication failed
            $credentials = ['email' => $DataLogin['email']];

            // Check if the email exists in the database
            if (!Auth::getProvider()->retrieveByCredentials($credentials)) {
                // Email does not exist
                return redirect()->route('login')->with('alert-gagal', 'Email tidak terdaftar')->withInput();
            } else {
                // Email exists, but password is incorrect
                return redirect()->route('login')->with('alert-gagal', 'Password salah')->withInput();
            }
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('alert-success', 'Logout Berhasil');
    }
}
