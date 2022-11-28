<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\NotesController;
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
    return true;
    //return $request->user();
});

Route::get('/notebook/', [ApiController::class, 'index']);

Route::post('/notebook/', [ApiController::class, 'store']);

Route::get('/notebook/{id}/', [ApiController::class, 'show']);

Route::post('/notebook/{id}/', [ApiController::class, 'update']);

Route::post('/notebook/delete/{id}/', [ApiController::class, 'destroy']);
