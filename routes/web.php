<?php

use App\Http\Controllers\Site\Authentication\RegistrationController;
use App\Http\Controllers\Site\Authentication\AuthorizationController;
use App\Http\Controllers\Site\Authentication\VkAuthController;
use App\Http\Controllers\Site\Interview\GetDirectionsController;
use App\Http\Controllers\Site\Interview\GetProfessionsController;
use App\Http\Controllers\Site\Interview\PreviewPageController;
use App\Http\Controllers\Site\Interview\InterviewStartController;
use App\Http\Controllers\Site\Interview\GetNextQuestionController;
use App\Http\Controllers\Site\Interview\AnswerTaskController;
use App\Http\Controllers\Site\Interview\GetResultsController;
use App\Http\Controllers\Site\Interview\InterviewInterruptController;

use App\Http\Controllers\Site\KnowledgeBase\GetProfessionsController as KB_GetProfessionsController;
use App\Http\Controllers\Site\KnowledgeBase\GetQuestionsController as KB_GetQuestionsController;

use App\Http\Controllers\Site\FavoriteSection\FavoriteQuestionController;

use App\Http\Controllers\Site\ContentExpansion\QuestionOfferController;

use App\Http\Controllers\TestController;
use App\Http\Controllers\GenerateContentController;


use Illuminate\Support\Facades\Route;

session_start();
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/generate={admin}', [GenerateContentController::class, 'createContent']);

Route::middleware('guest')->group(function () {

    Route::get('registration', [RegistrationController::class, 'create']);
    Route::post('registration', [RegistrationController::class, 'store'])->name('registration');

    Route::get('login', [AuthorizationController::class, 'create']);
    Route::post('login', [AuthorizationController::class, 'store'])->name('login');

    Route::get('auth/vkontakte', [VkAuthController::class, 'redirect'])->name('vkontakte');
    Route::get('auth/vkontakte/callback', [VkAuthController::class, 'login']);
});

Route::middleware(['auth:web','logoutUserType'])->group(function () {

    Route::middleware('simulationInActive')->group(function () {
        Route::get('interview/question', [GetNextQuestionController::class, 'create'])->name('interviewQuestion');
        Route::get('interview/question/answer={answer}', [AnswerTaskController::class, 'answerTask'])->name('interviewAnswerTask');
        Route::get('/interview/results', [GetResultsController::class, 'create'])->name('interviewResults');
        Route::get('/interview/interrupt', [InterviewInterruptController::class, 'interrupt'])->name('interviewInterrupt');
    });

    Route::middleware('simulationActive')->group(function () {
        Route::get('/interview/new', [GetDirectionsController::class, 'create'])->name('interviewDirection');
        Route::get('/interview/new/direction={idd}', [GetProfessionsController::class, 'create'])->name('interviewProfession');
        Route::get('interview/new/direction/profession={idd}', [PreviewPageController::class, 'create'])->name('interviewPreview');
        Route::get('interview/start={idd}', [InterviewStartController::class, 'start'])->name('interviewStart');

        Route::get('/knowledgebase/professions', [KB_GetProfessionsController::class, 'create'])->name('getProfessionsForKnowledgeBase');
        Route::get('/knowledgebase/professions/questions={idd}', [KB_GetQuestionsController::class, 'getQuestionsForKnowledgeBase'])->name('getQuestionsForKnowledgeBase');

        Route::get('/logout', function () {

            session_destroy();
            \Illuminate\Support\Facades\Auth::guard('web')->logout();
            return redirect(route('login'));
        });
    });

    Route::get('/favorite/add={idd}', [FavoriteQuestionController::class, 'add'])->name('questionFavoriteAdd');
    Route::get('/favorite/delete={idd}', [FavoriteQuestionController::class, 'delete'])->name('questionFavoriteDel');

    Route::get('/expansion/', [QuestionOfferController::class, 'create'])->name('expansionContent');
    Route::get('/expansion/store', [QuestionOfferController::class, 'store']);
    Route::post('/expansion/store', [QuestionOfferController::class, 'store'])->name('questionOfferForm');
    Route::get('/expansion/view={idd}', [QuestionOfferController::class, 'view'])->name('questionOfferView');
    Route::get('/expansion/delete={idd}', [QuestionOfferController::class, 'delete'])->name('questionOfferDelete');
    Route::get('/expansion/update={idd}', [QuestionOfferController::class, 'update']);
    Route::post('/expansion/update={idd}', [QuestionOfferController::class, 'update'])->name('questionOfferUpdate');;
    Route::get('/expansion/visible={idd}', [QuestionOfferController::class, 'visible'])->name('questionOfferVisible');
});
Route::get('test', [TestController::class, 'test']);




Route::get('/generate={admin}', [GenerateContentController::class, 'createContent']);

Route::fallback(function () {
    return redirect(route('login'));
});
