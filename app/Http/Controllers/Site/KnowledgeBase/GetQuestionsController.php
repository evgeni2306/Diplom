<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\KnowledgeBase;

use App\Models\FavoriteQuestion;
use App\Models\Profession;
use App\Models\Question;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GetQuestionsController extends Controller
{
    //AJAX
    public function getQuestionsForKnowledgeBase(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'profName' => 'required|string|max:255|exists:professions,name',
        ]);
        $fields= $request->all();
        if ($validator->fails()) {
            dd('no');
        }
        $profId = Profession::getProfIdByName($fields['profName']);
        $userId = Auth::user()->getAuthIdentifier();
        $questions = Question::getQuestionsByProfId($profId);
        foreach ($questions as $quest) {
            $quest = FavoriteQuestion::checkFavorite($quest, $userId);
        }
        return response()->json($questions, 200, ['Content-Type' => 'string']);
    }


}
