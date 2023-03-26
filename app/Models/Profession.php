<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'creator_id',
        'direction_id'
    ];

    static function getProfByDirectionId(int $directionId): Collection
    {
        return self::query()->where('direction_id', $directionId)->select('id', 'name')->get();
    }

    static function getProfById(int $profId): Collection
    {
        return self::query()->where('id', $profId)->select('id', 'name')->get();
    }

    static function getProfIdByName(string $profName): int
    {
        return self::query()->where('name', '=', $profName)->first()->id;
    }

    static function getGeneralStatistic(int $profId, int $userId): array
    {
        $categoryData = CatQuestCount::query()
            ->join('categories', 'categories.id', '=', 'category_id')
            ->select('category_id as categoryId', 'name')
            ->where('profession_id', '=', $profId)
            ->get()->all();
        foreach ($categoryData as $item) {
            $correctCount = 0;
            $tasks = Task::query()
                ->join('interviews', 'interviews.id', 'interview_id')
                ->join('questions', 'questions.id', '=', 'question_id')
                ->join('categories', 'categories.id', '=', 'category_id')
                ->select('tasks.status', 'categories.name')
                ->where('user_id', '=', $userId)
                ->where('category_id', '=', $item->categoryId)
                ->get()->all();
            foreach ($tasks as $task) {
                if ($task->status === 1) {
                    $correctCount++;
                }
            }
            $item->correctCount = (integer)($correctCount / count($tasks) * 100);
            $item->count = count($tasks);
        }
        return $categoryData;
    }

    static function getGeneralCorrectAnswersPercent(int $profId, int $userId): int
    {
        $correctCount = 0;
        $tasks = Task::query()
            ->join('interviews', 'interviews.id', 'interview_id')
            ->join('questions', 'questions.id', '=', 'question_id')
            ->join('categories', 'categories.id', '=', 'category_id')
            ->select('tasks.status', 'categories.name')
            ->where('user_id', '=', $userId)
            ->where('profession_id', '=', $profId)
            ->get()->all();
        foreach ($tasks as $task) {
            if ($task->status === 1) {
                $correctCount++;
            }
        }
        return (int)($correctCount / count($tasks) * 100);
    }

}
