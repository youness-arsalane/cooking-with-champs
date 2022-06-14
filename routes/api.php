<?php

use Illuminate\Http\Request;
use App\Http\Controllers\RecipeController;
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

Route::post('/recipes/create', [RecipeController::class, 'create']);

Route::get('recipes', [RecipeController::class, 'index']);

Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit']);

Route::put('/recipes/{recipe}', [RecipeController::class, 'update']);

Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy']);

Route::get('/recipes/manage', [RecipeController::class, 'manage']);

Route::get('/recipes/{recipe}', [RecipeController::class, 'show']);
