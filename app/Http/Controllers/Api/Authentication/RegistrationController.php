<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function registration(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 404, ['Content-Type' => 'string']);

        }
        $fields = $request->all();
        $fields['key'] = time();
        $user = User::query()->create($fields);
        return response()->json(['key' => $user['key']], 200, ['Content-Type' => 'string']);
    }
}
