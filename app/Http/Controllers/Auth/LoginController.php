<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('contents.Auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email-username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var(request()->input('email-username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => request()->input('email-username'), 'password' => request()->input('password')], request()->has('remember'))) {
            activity()->causedBy(Auth::user())->log(Auth::user()->username . ' telah login');
            return redirect()->route('dashboard');
        }

        if ($fieldType == 'email') {
            return redirect()->back()->with(['LoginError' => 'Email atau Password yang Anda masukan salah.']);
        } else {
            return redirect()->back()->with(['LoginError' => 'Username atau Password yang Anda masukan salah.']);
        }
    }

    public function logout(Request $request)
    {
        activity()->causedBy(Auth::user())->log(Auth::user()->username . ' telah logout');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
