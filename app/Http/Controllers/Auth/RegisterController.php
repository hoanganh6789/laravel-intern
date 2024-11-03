<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    private const LOGIN_MESSAGE = 'Đăng Nhập Thành Công';
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showFormRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);
        $data['password'] = Hash::make($data['password']);

        $user = User::query()->create($data);

        Auth::login($user);

        $request->session()->regenerate();
        
        Toastr::showToastr()->addSuccess(null, self::LOGIN_MESSAGE);
        return redirect()->route('home');
    }
}
