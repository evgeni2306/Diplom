<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Authentication;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthorizationController extends Controller
{
    public function create($errorMessage = null)
    {
        return view('Auth.Login.Login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:255|exists:users,login',
            'password' => 'required|string',
        ]);

        $fields = $request->all('login', 'password');
        if (Auth::guard('web')->attempt($fields)) {
            return redirect(\route(RouteServiceProvider::USERHOME));
        }
        return $this->create($errorMessage = 'Не удалось авторизоваться, проверьте правильность вводимых данных');

    }
}
