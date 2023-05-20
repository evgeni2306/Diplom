<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class VkAuthController extends Controller
{
    public function redirect(): \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function login(): \Illuminate\Http\RedirectResponse
    {
        $socialUser = Socialite::driver('vkontakte')->user();
        $isUser = User::query()->where('social_id', $socialUser->id)->first();
        if ($isUser) {
            $_SESSION['userName'] = $isUser->name;
            Auth::login($isUser);
        } else {
            $nameAndSurname = explode(' ', $socialUser->name);
            $createUser = User::query()->create([
                'name' => $nameAndSurname[0],
                'surname' => $nameAndSurname[1],
                'login' => $nameAndSurname[0] . time(),
                'key' => time(),
                'password' => encrypt('socialUser'),
                'social_id' => $socialUser->id,
            ]);
            $_SESSION['userName'] = $createUser->name;
            Auth::login($createUser);

        }
        return redirect(route(RouteServiceProvider::USERHOME));
    }
}
