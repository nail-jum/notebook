<?php

use App\Http\Controllers\NotesController;
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

//Route::get('/', function () {
    //return view('welcome');
//});

Route::get('/', [NotesController::class, 'index']);

Route::get('/index', [NotesController::class, 'index']);

Route::get('/add', [NotesController::class, 'create']);

Route::post('/add', [NotesController::class, 'store']);

Route::get('/show/{id}', [NotesController::class, 'show']);

Route::get('/edit/{id}', [NotesController::class, 'edit']);

Route::post('/edit', [NotesController::class, 'update']);

Route::get('/delete/{id}', [NotesController::class, 'delete']);

Route::post('/delete/{id}', [NotesController::class, 'destroy']);

Route::get('/api-test', function () {
    return view('api-test');
});
