<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // Show profile
    public function show(User $user)
    {

        return view('user.profile', ['user' => $user]);

    }

    // Create user
    public function create()
    {
        
        return view('user.register');

    }

    // Store user data
    public function store(Request $request)
    {

        // Declare user input variable
        // $userInput will validate each input and will be passed through the create() function with a $user declare
        // Once $user declared, automatically log user in with auth()->login($user)
        
        $userInput = $request->validate([
            'name'      => 'required',
            'email'     => ['required', 'email'],
            'username'  => 'required|min:6',
            'password'  => 'required|confirmed|min:9'
        ]);

        $userInput['password'] = bcrypt($userInput['password']);

        $user = User::create($userInput);

        auth()->login($user);

        return redirect('/');

    }
    
    // Show login form
    public function login()
    {

        return view('user.login');

    }

    // Log user in
    public function authenticate(Request $request)
    {

        // Declare user input variable
        // $userInput will validate each input and will be passed through the create() function with a $user declare

        $userInput = $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        // Validate user input attempt

        if (auth()->attempt($userInput))
        {

            $request->session()->regenerate();

            return redirect('/');

        }

        return back()->withErrors(['username' => 'Invalid credentials'])->onlyInput('username');

    }

}