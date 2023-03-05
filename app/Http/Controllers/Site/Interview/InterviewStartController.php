<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Interview;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Interview;
use Illuminate\Support\Facades\Auth;

class InterviewStartController extends Controller
{
    public function start(int $profId): \Illuminate\Http\RedirectResponse
    {
        if (is_numeric($profId) and $profId > 0) {
            $userId = Auth::user()->getAuthIdentifier();
            $interview = Interview::query()->create(['user_id' => $userId, 'profession_id' => $profId]);
            Task::createTasksForInterview($profId, $interview->id);
            $_SESSION["profId"] = (int)$profId;
            $_SESSION["interviewId"] = (int)$interview->id;
            return redirect(route('interviewQuestion'));
        }
        return redirect()->back();

    }


}
