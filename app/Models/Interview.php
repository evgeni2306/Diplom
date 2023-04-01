<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profession_id',
        'status'
    ];

    protected $attributes = [
        'status' => null,
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    static function getInterviewResults(int $interviewId): \stdClass
    {
        $countRight = Task::query()->where('interview_id', $interviewId)->where('status', '=', 1)->count();
        $countWrong = Task::query()->where('interview_id', $interviewId)->where('status', '=', 0)->count();
        $wrongQuestions = Task::query()->join('questions', 'question_id', '=', 'questions.id')
            ->join('categories', 'questions.category_id', '=', 'categories.id')
            ->select('questions.id as questionId', 'questions.question', 'categories.name as category')
            ->where('interview_id', '=', $interviewId)
            ->where('status', '=', 0)
            ->get();
        return (object)array('countRight' => $countRight, 'countWrong' => $countWrong, 'wrongQuestions' => $wrongQuestions);

    }

    static function interrupt(int $interviewId): int
    {
        $interview = self::query()->find($interviewId);
        if ($interview->status === null) {
            $tasks = $interview->tasks;
            foreach ($tasks as $task) {
                Task::destroy($task->id);
            }
            Interview::destroy($interview->id);
            return 1;
        }
        return 0;
    }

    static function changeInterviewStatus(int $interviewId): void
    {
        self::query()->where('id', '=', $interviewId)
            ->update(['status' => 1]);
    }

    static function getStatisticList(int $userId): array
    {
        $interviews = self::query()->join('professions', 'professions.id', '=', 'profession_id')
            ->select('name', 'profession_id as profId')->where('user_id', '=', $userId)->distinct()->get()->all();
        foreach ($interviews as $item) {
            $item->count = self::query()
                ->where('user_id', '=', $userId)
                ->where('profession_id', '=', $item->profId)
                ->count();
        }
        return $interviews;
    }

    static function getStatisticDiagram(int $profId, int $userId): \Illuminate\Database\Eloquent\Collection
    {
        $diagramData = Interview::query()
            ->select('id', 'created_at', 'profession_id as profId')->latest()
            ->where('user_id', '=', $userId)
            ->where('profession_id', '=', $profId)
            ->get()->take(10)->reverse();
        foreach ($diagramData as $item) {
            $item->created_at = $item->created_at->toFormattedDateString();
            $count = CatQuestCount::getSumCountQuestsForProf($item->profId);
            $countRight = Task::query()->where('interview_id', $item->id)->where('status', '=', 1)->count();
            $item->count = $countRight * 100 / $count;
        }
        return $diagramData;
    }

    static function getInterviewProgress(int $userId, int $interviewId): \stdClass
    {
        $tasks = Task::query()
            ->join('interviews', 'interviews.id', '=', 'interview_id')
            ->where('interview_id', '=', $interviewId)
            ->where('user_id', '=', $userId);
        $progressData = new \stdClass();
        $progressData->count = $tasks->get()->count();
        $progressData->countRight = $tasks->where('tasks.status', '=', '1')->get()->count();
        return $progressData;
    }

    static function getInterviewCategoryData(int $userId, $interviewId)
    {
        $categories = Category::query()
            ->join('questions', 'categories.id', '=', 'category_id')
            ->join('tasks', 'questions.id', '=', 'question_id')
            ->select('categories.id','categories.name')
            ->where('interview_id', '=', $interviewId)
            ->distinct()->get()->all();
        foreach ($categories as $item) {
            $correctCount = 0;
            $tasks = Task::query()
                ->join('interviews', 'interviews.id', 'interview_id')
                ->join('questions', 'questions.id', '=', 'question_id')
                ->join('categories', 'categories.id', '=', 'category_id')
                ->select('tasks.status', 'categories.name')
                ->where('interview_id', '=', $interviewId)
                ->where('user_id', '=', $userId)
                ->where('category_id', '=', $item->id)
                ->get()->all();

            foreach ($tasks as $task) {
                if ($task->status === 1) {
                    $correctCount++;
                }
            }
            $item->correctCount = (integer)($correctCount / count($tasks) * 100);
            $item->count = count($tasks);
        }
        return $categories;
    }

}
