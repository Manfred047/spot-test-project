<?php

use App\Http\Controllers\SpotController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('price-m2/zip-codes/{zipCode}/aggregate/{aggregateType}', [SpotController::class, 'show'])
    ->where(['zipCode' => '[0-9]+', 'type' => '((max)|(min)|(avg))*$'])
    ->name('api.spot.show');
