<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Http\Controllers\Controller;
use App\Models\Sphere;
use Illuminate\Http\Response;

class GetSpheresController extends Controller
{
    public function get(): \Illuminate\Http\JsonResponse|string
    {
        $spheres = Sphere::all('name', 'id');
        if (count($spheres) == 0) {
            return response()->json(['message' => 'Никаких сфер на найдено'], 404, ['Content-Type' => 'string']);
        }
        return response()->json($spheres, 200, ['Content-Type' => 'string']);
    }
}
