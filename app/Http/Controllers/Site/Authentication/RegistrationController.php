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
    public function create($errorMessage = null)
    {
        return view('Auth.Register.Register', ['errorMessage' => $errorMessage]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->create($errorMessage = $validator->errors()->messages()['login'][0]);
        }
        $fields = $request->all();
        $fields['key'] = time();
        $user = User::query()->create($fields);
        if ($user) {
            Auth::login($user);
             return redirect(route(RouteServiceProvider::USERHOME));
        }
    }
}
