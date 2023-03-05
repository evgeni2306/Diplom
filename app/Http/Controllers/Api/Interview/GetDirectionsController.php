<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use Illuminate\Http\Response;

class GetDirectionsController extends Controller
{
    public function get(int $id): \Illuminate\Http\JsonResponse
    {

        if (is_numeric($id) and $id > 0) {
            $directions = Direction::getDirBySphereId((int)$id);
            if (count($directions) == 0) {
                return response()->json(['message' => 'Направлений по этой сфере не найдено'], 404, ['Content-Type' => 'string']);
            }
            return response()->json($directions, 200, ['Content-Type' => 'string']);
        }
        return response()->json(['message' => 'Направление не найдено'], 404, ['Content-Type' => 'string']);

    }

}
