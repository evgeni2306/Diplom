<?php

use App\Http\Controllers\Site\AdminPanel\AuthorizationController;
use App\Http\Controllers\Site\AdminPanel\TestController;
use App\Http\Controllers\Site\AdminPanel\QuestionOfferController;

use Illuminate\Support\Facades\Route;


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


Route::name('admin.')->group(function () {
    Route::get('login', [AuthorizationController::class, 'create']);
    Route::post('login', [AuthorizationController::class, 'store'])->name('login');

    Route::middleware(['auth:admin','logoutUserType'])->group(function () {
        Route::get('expansion', [QuestionOfferController::class, 'list'])->name('expansion');
        Route::get('/expansion/view={idd}', [QuestionOfferController::class, 'view'])->name('QuestionOfferView');
        Route::post('/expansion/add', [QuestionOfferController::class, 'save'])->name('questionOfferForm');
        Route::post('/expansion/refuse', [QuestionOfferController::class, 'refuse'])->name('questionOfferRefuse');
    });
});






Route::get('/logout', function () {
    session_destroy();
    auth('admin')->logout();
    return redirect(route('admin.login'));
});

