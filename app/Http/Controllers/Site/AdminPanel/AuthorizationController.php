<?php

namespace App\Http\Controllers\Site\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthorizationController extends Controller
{
    public function create($errorMessage = null): \Illuminate\Contracts\View\View
    {
        return view('AdminPanel.Login.Login');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:255|exists:admin_users,login',
            'password' => 'required|string',
        ]);

        $fields = $request->all('login', 'password');
        if (Auth::guard('admin')->attempt($fields)) {
            return redirect(route('admin.expansion'));
        }
        return $this->create($errorMessage = 'Не удалось авторизоваться, проверьте правильность вводимых данных');

    }
}
