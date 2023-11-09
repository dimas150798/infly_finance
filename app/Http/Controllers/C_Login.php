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
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('alert-success', 'Login Berhasil');
            } elseif (Auth::user()->role == 'superadmin') {
                return redirect()->route('superadmin.dashboard')->with('alert-info', 'Selamat datang, Superadmin! Fitur Belum Ada');
            } else {
                return redirect()->route('user.dashboard')->with('alert-info', 'Selamat datang, Pengguna! Fitur Belum Ada');
            }
        } else {
            return redirect()->route('login')->with('alert-danger', 'Login Gagal')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('alert-success', 'Logout Berhasil');
    }
}
