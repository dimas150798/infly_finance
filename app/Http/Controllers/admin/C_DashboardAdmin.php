<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class C_DashboardAdmin extends Controller
{
    function index()
    {
        $title = 'Dashboard | Admin';
        return view('admin/V_DashboardAdmin', compact('title'));
    }
}
