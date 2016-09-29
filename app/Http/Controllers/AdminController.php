<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function themes()
    {
        return view('themes');
    }

    public function users()
    {
        return view('users');
    }

    public function finance()
    {
        return view('finance');
    }

    public function settings()
    {
        return view('settings');
    }

}
