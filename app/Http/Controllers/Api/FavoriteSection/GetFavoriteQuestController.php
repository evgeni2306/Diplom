<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\FavoriteSection;

use App\Models\FavoriteQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GetFavoriteQuestController extends Controller
{
    public function get(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Запрос не проходит валидацию'], 404, ['Content-Type' => 'string']);
        }
        $userId = User::getIdByKey($validator->getData()['authKey']);
        $favoriteList = FavoriteQuestion::getFavoriteList($userId);
        return response()->json($favoriteList, 200, ['Content-Type' => 'string']);
    }
}
