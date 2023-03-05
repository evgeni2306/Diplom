<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Interview;

use App\Http\Controllers\Controller;
use App\Models\FavoriteQuestion;
use App\Models\Interview;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class GetNextQuestionController extends Controller
{
    public function create()
    {

        $interviewId = $_SESSION["interviewId"];
        $userId = Auth::user()->getAuthIdentifier();

        $task = Task::getQuestion($interviewId);
        if ($task === null) {
            Interview::changeInterviewStatus($interviewId);
            return redirect(route('interviewResults'));

        }
        $question = FavoriteQuestion::checkFavorite($task, $userId);
        $question->profName = $_SESSION['profName'];
        $_SESSION["taskId"] = (int)$question->taskId;
        return view('Interview.InterviewQuestion.InterviewQuestion',['question' => $question]);
    }


}
