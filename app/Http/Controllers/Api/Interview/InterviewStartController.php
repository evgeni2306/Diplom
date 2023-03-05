<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Interview;
use Illuminate\Support\Facades\Validator;

class InterviewStartController extends Controller
{
    public function start(Request $request): \Illuminate\Http\JsonResponse

    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'profId' => 'required|integer|exists:professions,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Запрос не проходит валидацию'], 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $userId = User::getIdByKey($data['authKey']);
        $profId = (int)$data['profId'];
        $interview = Interview::query()->create(['user_id' => $userId, 'profession_id' => $profId]);
        Task::createTasksForInterview($profId, $interview->id);
        return response()->json(['interviewId' => $interview->id], 200, ['Content-Type' => 'string']);
    }
}
