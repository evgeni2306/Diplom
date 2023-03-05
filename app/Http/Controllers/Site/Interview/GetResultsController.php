<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Interview;

use App\Models\FavoriteQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Interview;

class GetResultsController extends Controller
{
    public function create()
    {
        $result = Interview::getInterviewResults($_SESSION["interviewId"]);
        $interview = Interview::query()->find($_SESSION["interviewId"]);
        $userId = Auth::user()->getAuthIdentifier();

        if ($interview->user_id === $userId) {
            foreach ($result->wrongQuestions as $item) {
                $item = FavoriteQuestion::checkFavorite($item, $userId);
            }
            $result->professionId = $_SESSION["profId"];
            return view('Interview.InterviewResults.InterviewResults',['results' => $result]);
        }
        return redirect()->back;
    }


}
