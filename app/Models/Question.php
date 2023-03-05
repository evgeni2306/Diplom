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

    ];

    static function getQuestionsByProfId(int $id): Collection
    {
        $questions = self::query()->join('cat_quest_counts', 'questions.category_id', '=', 'cat_quest_counts.category_id')
            ->join('professions', 'profession_id', '=', 'professions.id')
            ->join('categories', 'categories.id', '=', 'questions.category_id')
            ->select('questions.id as questionId', 'questions.question','questions.answer','categories.name as category')
            ->where('professions.id', '=', $id)
            ->get();
        return $questions;
    }
}
