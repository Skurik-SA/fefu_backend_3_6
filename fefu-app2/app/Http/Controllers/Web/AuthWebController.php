<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AuthWebController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * @return Application|Factory|View
     */
    public function registrationForm()
    {
        return view('auth.registration');
    }

    /**
     * @param LoginFormRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function login(LoginFormRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data, true))
        {
            $request->session()->regenerate();

            $user = Auth::user();
            $user->app_logged_in_at = Carbon::now();
            $user->save();

            return redirect('profile');
        }

        return back()->withErrors([
            'email'=>'invalid'
        ]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    /**
     * @param RegistrationFormRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function registration(RegistrationFormRequest $request)
    {
        $data = $request->validated();

        $user = User::query()->where('email', $data['email'])->first();
        if ($user)
        {
            $user = User::changeFromRequest($user, $data);
        }
        else
        {
            $user = User::createFromRequest($data);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect(route('profile'));
    }
}
