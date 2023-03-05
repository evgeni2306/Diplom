<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\KnowledgeBase;

use App\Models\FavoriteQuestion;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GetQuestionsController extends Controller
{
    public function get(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'profId' => 'required|integer|exists:professions,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Запрос не проходит валидацию'], 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $userId = User::getIdByKey($data['authKey']);
        $profId = (int)$data['profId'];
        $questions = Question::getQuestionsByProfId($profId);
        foreach ($questions as $quest) {
            $quest = FavoriteQuestion::checkFavorite($quest, $userId);
        }
        return response()->json($questions, 200, ['Content-Type' => 'string']);
    }
}
