<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\KnowledgeBase;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GetProfessionsController extends Controller
{
    public function get(Request $request): \Illuminate\Http\JsonResponse

    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Запрос не проходит валидацию'], 404, ['Content-Type' => 'string']);
        }
        $professions = Profession::all('id as profId', 'name');
        return response()->json($professions, 200, ['Content-Type' => 'string']);
    }
}
