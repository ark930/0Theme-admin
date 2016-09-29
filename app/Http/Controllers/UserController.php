<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function login()
    {
        return redirect('/dashboard');
    }

    public function logout()
    {
        return redirect('/');
    }
}
