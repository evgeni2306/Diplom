<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
    ];

    static function checkFavorite(Task|Question|Model $question, int $userId): Task|Question
    {
        $favorite = self::query()->where('question_id', '=', $question->questionId)
            ->where('user_id', '=', $userId)->first();
        if ($favorite != null) {
            $question->isFavorite = 1;
            $question->favoriteId = $favorite->id;
            return $question;
        }
        $question->isFavorite = 0;
        $question->favoriteId = 0;
        return $question;
    }
    static function getFavoriteList(int $userId): array|\Illuminate\Database\Eloquent\Collection
    {
        $favoriteList = self::query()
            ->join('questions', 'questions.id', '=', 'question_id')
            ->join('categories', 'categories.id', '=', 'category_id')
            ->select('favorite_questions.id as favoriteId','question','answer','categories.name as category')
            ->where('user_id','=',$userId)
            ->get();
        return $favoriteList;
    }
}
