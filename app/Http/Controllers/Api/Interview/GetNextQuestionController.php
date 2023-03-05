<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Http\Controllers\Controller;
use App\Models\FavoriteQuestion;
use App\Models\Interview;
use App\Models\InterviewTemplate;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class GetNextQuestionController extends Controller
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
        $interviewId = (int)$data['interviewId'];
        $userId = User::getIdByKey($data['authKey']);

        $task = Task::getQuestion($interviewId);
        if ($task == null) {
            Interview::changeInterviewStatus($interviewId);
            InterviewTemplate::createTemplate($interviewId);
            return response()->json(['message' => 'Нет вопросов'], 204, ['Content-Type' => 'string']);
        }
        $question = FavoriteQuestion::checkFavorite($task, $userId);
        return response()->json($question, 200, ['Content-Type' => 'string']);
    }
}
