<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',  //['required', 'min:8']
        ]);

        $user = User::create($attributes);

        //log in user
        auth()->login($user);

        //session()->flash('success', 'Your account has been created');

        return redirect('/')->with('success', 'Your account has been created');
    }
}
