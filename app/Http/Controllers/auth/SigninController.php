<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SigninController extends Controller
{
    public function index()
    {
        return view('auth.signin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        Session::regenerate();
        noty()->addSuccess('Selamat datang!');
        return Redirect::intended(RouteServiceProvider::HOME);
    }

    public function destroy()
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        noty()->addSuccess('Selamat tinggal!');
        return Redirect::back();
    }
}
