<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Alert;
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

            $userSocial = $this->findOrNewUserSocial($social, $providerUser);

            if ($userSocial->exists && $userSocial->user) {
                return $this->handleLogin($userSocial->user);
            }

            $user = $this->findOrCreateUser($providerUser);

            $userSocial->user()->associate($user);
            $userSocial->save();

            Toastr::success(null, self::SUCCESS_MESSAGE);
            return $this->handleLogin($user);
        } catch (\Throwable $th) {
            Toastr::error(null, self::ERROR_MESSAGE);
            Log::error($th->getMessage());
            return redirect()->route('login');
        }
    }

    private function findOrNewUserSocial($social, $provider)
    {
        return UserSocial::query()
            ->firstOrNew([
                'provider' => $social,
                'provider_id' =>  $provider->getId()
            ]);
    }

    private function findOrCreateUser($providerUser)
    {
        return User::query()
            ->firstOrCreate(
                ['email' => $providerUser->getEmail()],
                [
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail()
                ]
            );
    }

    private function handleLogin($user)
    {
        Auth::login($user);

        $redirectRoute = $user->isAdmin() ? 'admin.dashboard' : 'home';

        Toastr::success(null, self::SUCCESS_MESSAGE);

        return redirect()->route($redirectRoute);
    }
}
