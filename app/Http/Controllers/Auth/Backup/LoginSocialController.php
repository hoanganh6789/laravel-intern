<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Alert;
use App\Http\Helpers\Toastr;
use App\Models\User;
use App\Models\UserSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginSocialController extends Controller
{
    private const ERROR_MESSAGE = 'Đăng nhập thất bại';
    private const SUCCESS_MESSAGE = 'Đăng nhập thành công';
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        try {
            $providerUser = Socialite::driver($social)->user();

            $userSocial = UserSocial::query()
                ->firstOrNew([
                    'provider' => $social,
                    'provider_id' =>  $providerUser->getId()
                ]);

            if ($userSocial->exists && $userSocial->user) {
                Auth::login($userSocial->user);
                Toastr::showToastr()->addSuccess(null, self::SUCCESS_MESSAGE);
                return redirect()->route('home');
            }

            $user = User::query()
                ->firstOrCreate(
                    ['email' => $providerUser->getEmail()],
                    [
                        'name' => $providerUser->getName(),
                        'email' => $providerUser->getEmail()
                    ]
                );

            $userSocial->user()->associate($user);
            $userSocial->save();

            Auth::login($user);
            Toastr::showToastr()->addSuccess(null, self::SUCCESS_MESSAGE);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            Toastr::showToastr()->addError(null, self::ERROR_MESSAGE);
            Log::error($th->getMessage());
            return redirect()->route('login');
        }
    }
}
