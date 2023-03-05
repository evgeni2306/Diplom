<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Interview;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AnswerTaskController extends Controller
{
    //AJAX
    public function answerTask(string $answer): \Illuminate\Http\RedirectResponse|JsonResponse
    {
        if ($answer != "true" and $answer != "false") {
            return redirect()->back();
        }
        $userId = Auth::user()->getAuthIdentifier();
        $checkTask = Task::query()->find($_SESSION["taskId"]);
        if ($checkTask->interview()->get()[0]->user_id === $userId) {
            $task = Task::answerTask($_SESSION["taskId"],filter_var($answer, FILTER_VALIDATE_BOOLEAN));
            if ($task != null) {
                return response()->json('ok', 200, ['Content-Type' => 'string']);
            }
        }

        return redirect()->back();
    }


}
