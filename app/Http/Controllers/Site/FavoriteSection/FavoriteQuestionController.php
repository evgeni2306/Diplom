<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\FavoriteSection;

use App\Models\FavoriteQuestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FavoriteQuestionController extends Controller
{
    public function add(int $id): \Illuminate\Http\JsonResponse|int
    {
        $userId = Auth::user()->getAuthIdentifier();
        try {
            $favoriteQuestion = FavoriteQuestion::query()->create(['user_id' => $userId, 'question_id' => $id]);
            return $favoriteQuestion->id;
        } catch (\Exception $exp) {
            return response()->json(['message' => 'Что-то пошло не так'], 404, ['Content-Type' => 'string']);
        }
    }

    public function delete(int $id): JsonResponse|\Illuminate\Http\RedirectResponse|int
    {
        $userId = Auth::user()->getAuthIdentifier();
        $favorite = FavoriteQuestion::query()->find($id);
        if ($favorite->user_id === $userId) {
            if (FavoriteQuestion::destroy($id)) {
                return 1;
            }
            return response()->json(['message' => 'Что-то пошло не так'], 404, ['Content-Type' => 'string']);
        }

        return redirect()->back;
    }


}
