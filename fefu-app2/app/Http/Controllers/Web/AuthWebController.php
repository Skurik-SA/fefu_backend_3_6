<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthWebController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registrationForm()
    {
        return view('auth.registration');
    }

    public function login(LoginFormRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data, true))
        {
            $request->session()->regenerate();

            return redirect('profile');
        }

        return back()->withErrors([
            'email'=>'invalid'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function registration()
    {

    }
}
