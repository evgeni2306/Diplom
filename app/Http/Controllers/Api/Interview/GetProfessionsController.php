<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Response;

class GetProfessionsController extends Controller
{
    public function get(int $id): \Illuminate\Http\JsonResponse
    {

        if (is_numeric($id) and $id > 0) {
            $professions = Profession::getProfByTechnologyId((int)$id);
            if (count($professions) == 0) {
                return response()->json(['message' => 'Профессий по этой технологии не найдено'], 404, ['Content-Type' => 'string']);
            }
            return response()->json($professions, 200, ['Content-Type' => 'string']);
        }
        return response()->json(['message' => 'Профессия не найдена'], 200, ['Content-Type' => 'string']);
    }
}
