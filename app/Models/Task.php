<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'interview_id',
        'status'
    ];
    protected $attributes = [
        'status' => null,
    ];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    static function getQuestion(int $interviewId): Model|null
    {
        $task = Task::query()->join('questions', 'question_id', '=', 'questions.id')
            ->join('categories', 'questions.category_id', '=', 'categories.id')
            ->select('tasks.id as taskId', 'questions.question', 'tasks.id as favoriteId', 'tasks.id as isFavorite', 'answer', 'categories.name as category', 'question_id as questionId')
            ->where('interview_id', '=', $interviewId)
            ->where('status', '=', null)
            ->first();
        if ($task !== null) {
            $tasks = Task::query()->where('interview_id', '=', $interviewId)->get();
            for ($i = 0; $i < count($tasks); $i++) {
                if ($tasks[$i]->id == $task->taskId) {
                    $task->current = $i + 1;
                    $task->amount = count($tasks);
                    break;
                }
            }
        }
        return $task;
    }

    static function createTasksForInterview(int $id, int $interviewId): void
    {
        $catQuestCount = CatQuestCount::query()->select('category_id', 'count')->inRandomOrder()->where('profession_id', $id)->get();
        foreach ($catQuestCount as $var) {
            $question = Question::query()->select('id as question_id')->inRandomOrder()->where('category_id', $var->category_id)->get();
            for ($i = 0; $i < $var->count; $i++) {
                $question[$i]->interview_id = $interviewId;
                $var1 = json_decode(json_encode($question[$i]), true);
                self::query()->create($var1);
            }
        }
    }

    static function answerTask(int $taskId, bool $answer)
    {
        $task = self::query()->find($taskId);
        if ($task->status == null) {
            $task->status = $answer;
            $task->save();
            return true;
        }
        return false;
    }
}
