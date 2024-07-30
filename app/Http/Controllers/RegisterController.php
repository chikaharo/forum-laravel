<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterController extends Controller
{
    //
    public function create() {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request) {
        User::create($request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]));
        
        return redirect('/')->with('success', 'Account created');
    }
}
