<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'creator_id',
        'question',
        'answer',
        'user_mark'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $attributes = [
        'user_mark' => false,
    ];

    static function getQuestionsByProfId(int $id): Collection
    {
        $questions = self::query()->join('cat_quest_counts', 'questions.category_id', '=', 'cat_quest_counts.category_id')
            ->join('professions', 'profession_id', '=', 'professions.id')
            ->join('categories', 'categories.id', '=', 'questions.category_id')
            ->select('questions.id as questionId', 'questions.question', 'questions.answer', 'categories.name as category')
            ->where('professions.id', '=', $id)
            ->get();
        return $questions;
    }

    static function addOfferedQuestion(int $offerId): void
    {
        $offer = QuestionOffer::query()->find($offerId, ['creator_id', 'category_id', 'question', 'answer'])->toArray();
        $offer['user_mark'] = 1;
        Question::query()->create((array)$offer);
    }


    static function adminGetListSimiliar(int $id): Model
    {
        return self::query()
            ->join('categories', 'categories.id', '=', 'questions.category_id')
            ->select('question', 'categories.name')
            ->where('questions.id', '=', $id)->first();
    }
}
