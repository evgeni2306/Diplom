<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Models\CatQuestCount;

class PreviewPageController extends Controller
{
    public function get(int $profId): \Illuminate\Http\JsonResponse|string
    {
        if (is_numeric($profId) and $profId > 0) {

            $profession = Profession::getProfById((int)$profId);
            if (count($profession) != 0) {
                foreach ($profession as $prof) {
                    $prof->count = CatQuestCount::getSumCountQuestsForProf((int)$profId);
                }
                return response()->json($profession[0], 200, ['Content-Type' => 'string']);
            }
            return response()->json(['message' => 'Профессия не найдена'], 404, ['Content-Type' => 'string']);
        }
        return response()->json(['message' => 'Профессия не найдена'], 404, ['Content-Type' => 'string']);
    }
}
