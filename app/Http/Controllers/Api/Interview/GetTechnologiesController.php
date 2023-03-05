<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Http\Controllers\Controller;
use App\Models\Technology;

class GetTechnologiesController extends Controller
{
    public function get(int $id): \Illuminate\Http\JsonResponse
    {

        if (is_numeric($id) and $id > 0) {
            $technologies = Technology::getTechByDirectionId((int)$id);
            if (count($technologies) == 0) {
                return response()->json(['message' => 'Технологий в этой сфере не найдено'], 404, ['Content-Type' => 'string']);
            }
            return response()->json($technologies, 200, ['Content-Type' => 'string']);
        }
        return response()->json(['message' => 'Технология не найдена'], 404, ['Content-Type' => 'string']);

    }
}
