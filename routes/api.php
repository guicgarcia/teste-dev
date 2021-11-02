<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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


Route::prefix('v1')->group(function() {

    Route::prefix('livros')->group(function() {
        // Route::get('', [BookController::class, 'index']);
        // Route::get('{book}', [BookController::class, 'show']);
        // Route::post('', [BookController::class, 'store']);
        // Route::put('{book}', [BookController::class, 'update']);
        // Route::delete('{book}', [BookController::class, 'destroy']);
        Route::post('filter', [BookController::class, 'filter']);
    });

});