<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Statistic;

use App\Http\Controllers\Controller;
use App\Models\FavoriteQuestion;
use App\Models\Interview;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StatisticConcreteController extends Controller
{
    public function index(int $id): View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $progressData = Interview::getInterviewProgress($userId, $id);
        $categoryData = Interview::getInterviewCategoryData($userId, $id);
        return view('Statistic.StatisticConcrete.StatisticConcrete',
            ['progressData' => $progressData, 'categoryData' => $categoryData,
                'interviewId' => $id]);
    }

    public function getQuestions(Request $request): JsonResponse
    {
        $fields = $request->all();
        $validator = Validator::make($request->all(), [
            'interviewId' => 'required|integer|exists:interviews,id',
            'categoryId' => 'required|integer|exists:categories,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 404, ['Content-Type' => 'string']);
        }
        $userId = Auth::user()->getAuthIdentifier();
        $questions = Task::getTasksForStatisticConcrete((int)$fields['interviewId'],(int)$fields['categoryId']);
        foreach ($questions as $quest) {
            $quest = FavoriteQuestion::checkFavorite($quest, $userId);
        }
        return response()->json($questions, 200, ['Content-Type' => 'string']);
    }

}
