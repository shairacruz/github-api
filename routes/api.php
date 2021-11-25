<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HammingDistance;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/hamming-distance', [HammingDistance::class, 'compute']);

// Login required
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/github/search/{username}', [SearchController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

