<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Authentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthorizationController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 404, ['Content-Type' => 'string']);
        }
        if (Auth::attempt($request->all('login', 'password'))) {
            return response()->json(['key' => Auth::user()->key], 200, ['Content-Type' => 'string']);
        }
        return response()->json([['message' => 'Не удалось авторизоваться, проверьте правильность заполнения полей']], 404, ['Content-Type' => 'string']);
    }
}
