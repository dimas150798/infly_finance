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
                echo "Fitur Belum Ada";
            } else {
                echo "Fitur Belum Ada";
            }
        } else {
            return redirect('')->with('alert-gagal', 'Login Gagal')->withInput();
        }
    }
}
