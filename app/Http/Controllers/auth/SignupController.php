<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class SignupController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:12', 'alpha'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'. User::class],
            'password' => ['required', 'string', 'confirmed', Password::defaults()]
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Auth::login($user);
        noty()->addSuccess('Kamu berhasil membuat account!');
        return Redirect::route('view.home');
    }
}
