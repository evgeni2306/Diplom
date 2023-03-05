<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Models\FavoriteQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Interview;

class GetResultsController extends Controller
{
    public function get(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'interviewId' => 'required|integer|exists:interviews,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Запрос не проходит валидацию'], 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $userId = User::getIdByKey($data['authKey']);
        $interviewId = (int)$data["interviewId"];
        $result = Interview::getInterviewResults($interviewId);

        $interview = Interview::query()->find($interviewId);

        if ($interview->user_id === $userId) {
            foreach ($result->wrongQuestions as $item) {
                $item = FavoriteQuestion::checkFavorite($item, $userId);
            }
            return response()->json($result, 200, ['Content-Type' => 'string']);
        }
        return response()->json(['message' => 'Выпытаетесь получить результаты чужой симуляции'], 404, ['Content-Type' => 'string']);

    }
}
