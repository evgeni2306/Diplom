<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Interview;

use App\Http\Controllers\Controller;
use App\Models\InterviewTemplate;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class InterviewTemplateController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
        ]);
        if ($validator->fails()) {
            return response()->json([['message' => 'Запрос не проходит валидацию']], 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $userId = User::getIdByKey($data['authKey']);
        $templates = InterviewTemplate::getTemplates($userId);
        return response()->json($templates, 200, ['Content-Type' => 'string']);
    }

    public function delete(Request $request): int|JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'templateId' => 'required|string|max:255|exists:interview_templates,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Запрос не проходит валидацию'], 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $templateId = $data['templateId'];
        $userId = User::getIdByKey($data['authKey']);

        $template = InterviewTemplate::query()->find($templateId);
        if ($template->user_id === $userId) {
            $template->delete();
            return 1;
        }
        return response()->json(['message' => 'Вы пытаетесь удалить чужой шаблон'], 404, ['Content-Type' => 'string']);

    }
}
