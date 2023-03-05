<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerTaskController extends Controller
{
    public function answerTask(Request $request): \Illuminate\Http\JsonResponse|int
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'taskId' => 'required|integer|exists:tasks,id',
            'answer' => 'required|bool'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Запрос не проходит валидацию'], 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $userId = User::getIdByKey($data['authKey']);
        $checkTask = Task::query()->find((int)$data['taskId']);
        if ($checkTask->interview()->get()[0]->user_id === $userId) {
            $task = Task::answerTask((int)$data['taskId'], (bool)$data['answer']);
            if ($task != null) {
                return 1;
            }
        }
        return response()->json(['message' => 'Вы пытаетесь ответить на чужой вопрос'], 404, ['Content-Type' => 'string']);
    }

}
