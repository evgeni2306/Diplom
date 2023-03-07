<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'creator_id',
        'question',
        'answer',
        'status',
        'comment',
        'visible'
    ];
    protected $attributes = [
        'status' => "Yellow",
        'comment' => null,
        'visible' => true,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    static function getUsersQuestionOffers(int $userId): array
    {
        return self::query()
            ->join('categories', 'categories.id', '=', 'category_id')
            ->where('question_offers.creator_id', '=', $userId)
            ->where('visible', '=', 1)
            ->select('question_offers.id', 'question', 'status', 'categories.name')
            ->get()->all();
    }

    static function getQuestionOfferById(int $offerId, int $userId): Model|null
    {
        return self::query()
            ->join('categories', 'categories.id', '=', 'category_id')
            ->where('question_offers.id', '=', $offerId)
            ->where('question_offers.creator_id', '=', $userId)
            ->where('visible', '=', 1)
            ->select('question_offers.id', 'question', 'answer', 'comment', 'status', 'categories.name')
            ->first();
    }

    static function deleteOfferById(int $offerId, int $userId): void
    {
        $offer = self::query()
            ->where('id', '=', $offerId)
            ->where('creator_id', '=', $userId)->first();
        if ($offer !== null) {
            $offer->delete();
        }
    }

    static function updateOffer(int $offerId, int $userId, array $fields): Model|null
    {
        $offer = self::query()
            ->where('id', '=', $offerId)
            ->where('creator_id', '=', $userId)->first();
        if ($offer !== null) {
            $offer->update(['categoryId' => $fields['category_id'], 'question' => $fields['question'], 'answer' => $fields['answer'], 'status' => 'Yellow']);
            return $offer;
        }
        return null;
    }

    static function changeVisible(int $offerId, int $userId): Model|null
    {
        $offer = self::query()
            ->where('id', '=', $offerId)
            ->where('creator_id', '=', $userId)->first();
        if ($offer !== null) {
            $offer->update(['visible' => 0]);
            return $offer;
        }
        return null;
    }
    
    static function adminStatusRefuse(int $offerId, string $comment): void
    {
        $offer = QuestionOffer::query()->find($offerId);
        $offer->comment = $comment;
        $offer->status = "Red";
        $offer->save();
    }

    static function adminStatusAccepted(int $offerId, string $question, string $answer): void
    {
        $offer = QuestionOffer::query()->find($offerId);
        $offer->update(['question' => $question, 'answer' => $answer, 'status' => 'Green']);
        $offer->save();
    }

    static function adminGetQuestionOfferTextById(int $id): string
    {
        $text = self::query()->select('question')->where('id', '=', $id)->first();
        return $text->question;
    }

}
