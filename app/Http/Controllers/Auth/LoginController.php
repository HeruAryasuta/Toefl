<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    protected function authenticated(Request $request, $user)
    {
        \Log::info('User role: ' . $user->role);
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->name);
        } elseif ($user->role === 'user') {
            return redirect()->route('dashboard.user')->with('success', 'Selamat datang, ' . $user->name);
        }

        return redirect()->route('login')->with('error', 'Role tidak valid.');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
