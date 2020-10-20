<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppealController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::prefix('appeal')->group(function () {
    Route::get('/not_read', [AppealController::class, 'allNotRead']);
    Route::get('/not_processed', [AppealController::class, 'allNotProcessed']);
    Route::get('/{id}', [AppealController::class, 'byId']);
    Route::post('/add', [AppealController::class, 'create']);
    Route::put('/mark_read/{id}', [AppealController::class, 'markRead']);
    Route::put('/mark_processed/{id}', [AppealController::class, 'markProcessed']);
    Route::put('/mark_rejected/{id}', [AppealController::class, 'markRejected']);
});

