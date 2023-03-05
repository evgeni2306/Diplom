<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authentication\RegistrationController;
use App\Http\Controllers\Api\Authentication\AuthorizationController;

use App\Http\Controllers\Api\Interview\InterviewTemplateController;
use App\Http\Controllers\Api\Interview\GetSpheresController;
use App\Http\Controllers\Api\Interview\GetDirectionsController;
use App\Http\Controllers\Api\Interview\GetTechnologiesController;
use App\Http\Controllers\Api\Interview\GetProfessionsController;
use App\Http\Controllers\Api\Interview\PreviewPageController;
use App\Http\Controllers\Api\Interview\InterviewStartController;
use App\Http\Controllers\Api\Interview\GetNextQuestionController;
use App\Http\Controllers\Api\Interview\AnswerTaskController;
use App\Http\Controllers\Api\Interview\GetResultsController;

use App\Http\Controllers\Api\KnowledgeBase\GetProfessionsController as KB_GetProfessionsController;
use App\Http\Controllers\Api\KnowledgeBase\GetQuestionsController as KB_GetQuestionsController;

use App\Http\Controllers\Api\FavoriteSection\FavoriteQuestionController;
use App\Http\Controllers\Api\FavoriteSection\GetFavoriteQuestController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/registration', [RegistrationController::class, 'registration']);
Route::post('/login', [AuthorizationController::class, 'login']);

Route::post('/interview/templates', [InterviewTemplateController::class, 'get']);
Route::post('/interview/templates/delete', [InterviewTemplateController::class, 'delete']);
Route::get('/interview/new', [GetSpheresController::class, 'get']);
Route::get('/interview/new/sphere={idd}', [GetDirectionsController::class, 'get']);
Route::get('/interview/new/sphere/direction={idd}', [GetTechnologiesController::class, 'get']);
Route::get('/interview/new/sphere/direction/technology={idd}', [GetProfessionsController::class, 'get']);
Route::get('/interview/new/sphere/direction/technology/profession={idd}', [PreviewPageController::class, 'get']);
Route::post('/interview/start', [InterviewStartController::class, 'start']);
Route::post('/interview/question', [GetNextQuestionController::class, 'get']);
Route::post('/interview/question/answer', [AnswerTaskController::class, 'answerTask']);
Route::post('/interview/results', [GetResultsController::class, 'get']);

Route::post('/knowledgebase/professions', [KB_GetProfessionsController::class, 'get']);
Route::post('/knowledgebase/professions/questions', [KB_GetQuestionsController::class, 'get']);

Route::post('/favorite/add', [FavoriteQuestionController::class, 'add']);
Route::post('/favorite/delete', [FavoriteQuestionController::class, 'delete']);
Route::post('/favorite/list', [GetFavoriteQuestController::class, 'get']);
