<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Interview;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnswerTaskController extends Controller
{

    public function answerTask(string $answer): \Illuminate\Http\RedirectResponse|JsonResponse
    {
        if ($answer != "true" and $answer != "false") {
            return redirect()->back();
        }
        $userId = Auth::user()->getAuthIdentifier();
        $checkTask = Task::query()->find($_SESSION["taskId"]);
        if ($checkTask->interview()->get()[0]->user_id === $userId) {
            $task = Task::answerTask($_SESSION["taskId"], filter_var($answer, FILTER_VALIDATE_BOOLEAN));
            if ($task != null) {
                return redirect(route('interviewQuestion'));
            }
        }

        return redirect()->back();
    }

    //AJAX
    public function recordAnswer(Request $request): JsonResponse
    {
        $fields = $request->all();
        $validator = Validator::make($fields, [
            'answer' => 'required|string',
        ]);
        if ($validator->fails()) {
            $fields['answer'] = "Не записан";
        }
        Task::recordAnswer($_SESSION["taskId"], $fields['answer']);
        return response()->json('ok', 200, ['Content-Type' => 'string']);
    }








    //AJAX
//    public function answerTask(string $answer): \Illuminate\Http\RedirectResponse|JsonResponse
//    {
//        if ($answer != "true" and $answer != "false") {
//            return redirect()->back();
//        }
//        $userId = Auth::user()->getAuthIdentifier();
//        $checkTask = Task::query()->find($_SESSION["taskId"]);
//        if ($checkTask->interview()->get()[0]->user_id === $userId) {
//            $task = Task::answerTask($_SESSION["taskId"],filter_var($answer, FILTER_VALIDATE_BOOLEAN));
//            if ($task != null) {
//                return response()->json('ok', 200, ['Content-Type' => 'string']);
//            }
//        }
//
//        return redirect()->back();
//    }


}
