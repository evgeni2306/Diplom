<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Authentication;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class RegistrationController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('Auth.Register.Register');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $fields = $request->all();
        $validator = Validator::make($fields, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect(route('registration'))->withErrors([
                'login' => 'Выбранный вами логин уже кем-то занят'
            ])->withInput();
        }

        $fields['key'] = time();
        $user = User::query()->create($fields);
        if ($user) {
            $_SESSION['userName'] = $user->name;
            Auth::login($user);
            return redirect(route(RouteServiceProvider::USERHOME));
        }
    }
}
