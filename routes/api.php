<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Type_identificationController;
use App\Http\Controllers\UserController;
use App\Models\Type_identification;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});

Route::group([
    // 'middleware' => 'api',
],function ($router) {
    Route::resource('user',UserController::class);
    Route::resource('type_id',Type_identificationController::class);
    Route::post('type/filtro',[Type_identificationController::class,'filtro']);
    Route::post('user/filtro',[UserController::class,'filtro']);

});
