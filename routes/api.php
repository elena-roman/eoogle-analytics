<?php

use App\Http\Controllers\Analytics\HitController;
use App\Http\Controllers\Analytics\UserJourneyController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

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

Route::post('statistics', [StatisticsController::class, 'store']);

Route::prefix('analytics')->group(function () {
    Route::prefix('hits')->group(function () {
        Route::get('/by-link/{link}', [HitController::class, 'getHitsByLink']);
        Route::get('/by-type/{linkType}', [HitController::class, 'getHitsByLinkType']);
    });

    Route::prefix('user-journey')->group(function () {
        Route::get('/{customer_uuid}', [UserJourneyController::class, 'getUserJourney']);
        Route::get('/{customer_uuid}/similar', [UserJourneyController::class, 'getUsersByUserJourney']);
    });
});
