<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\FavoriteSection;

use App\Models\FavoriteQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class FavoriteQuestionController extends Controller
{
    public function add(Request $request): \Illuminate\Http\JsonResponse|int
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'questionId' => 'required|integer|exists:questions,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Запрос не проходит валидацию'], 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $userId = User::getIdByKey($data['authKey']);
        try {
            $favoriteQuestion = FavoriteQuestion::query()->create(['user_id' => $userId, 'question_id' => $data['questionId']]);
            return $favoriteQuestion->id;
        } catch (\Exception $exp) {
            return response()->json(['message' => 'Что-то пошло не так'], 404, ['Content-Type' => 'string']);
        }
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse|int
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'favoriteId' => 'required|integer|exists:favorite_questions,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Запрос не проходит валидацию'], 404, ['Content-Type' => 'string']);
        }

        $data = $validator->getData();
        $favoriteId = (int)$data["favoriteId"];
        $userId = User::getIdByKey($data['authKey']);
        $favorite = FavoriteQuestion::query()->find($favoriteId);

        if ($favorite->user_id === $userId) {
            if (FavoriteQuestion::destroy($favoriteId)) {
                return 1;
            }
            return response()->json(['message' => 'Что-то пошло не так'], 404, ['Content-Type' => 'string']);
        }
        return response()->json(['wrong account'], 404, ['Content-Type' => 'string']);
    }
}
