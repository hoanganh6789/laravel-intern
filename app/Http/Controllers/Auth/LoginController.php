<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    private const LOGOUT_MESSAGE = 'Đăng xuất thành công';
    private const LOGIN_MESSAGE = 'Đăng nhập thành công';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $redirectRoute = Auth::user()->isAdmin() ? 'admin.dashboard' : 'home';

            Toastr::success(null, self::LOGIN_MESSAGE);

            return redirect()->route($redirectRoute);
        }

        return back()->withErrors(['email' => __('auth.failed')])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        Toastr::success(null, self::LOGOUT_MESSAGE);
        return redirect()->route('home');
    }
}
