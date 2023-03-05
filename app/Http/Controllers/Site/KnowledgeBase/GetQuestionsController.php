<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\KnowledgeBase;

use App\Models\FavoriteQuestion;
use App\Models\Question;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class GetQuestionsController extends Controller
{
    //AJAX
    public function getQuestionsForKnowledgeBase(int $profId): \Illuminate\Http\JsonResponse
    {
        $userId = Auth::user()->getAuthIdentifier();
        $questions = Question::getQuestionsByProfId($profId);
        foreach ($questions as $quest) {
            $quest = FavoriteQuestion::checkFavorite($quest, $userId);
        }
        return response()->json($questions, 200, ['Content-Type' => 'string']);
    }


}
