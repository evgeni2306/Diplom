<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Authentication;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthorizationController extends Controller
{
    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('Auth.Login.Login');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $fields = $request->all('login', 'password');
        $validator = Validator::make($fields, [
            'login' => 'required|string|max:255|exists:users,login',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect(route('login'))->withErrors([
                'login' => 'Не удалось авторизоваться, проверьте правильность вводимых данных'
            ])->withInput();
        }
        if (Auth::guard('web')->attempt($fields)) {
            return redirect(\route(RouteServiceProvider::USERHOME));
        }
        return redirect(route('login'))->withErrors([
            'login' => 'Не удалось авторизоваться, проверьте правильность вводимых данных'
        ])->withInput();

    }
}
