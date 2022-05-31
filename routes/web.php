<?php

use App\Http\Controllers\RecipeController;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [RecipeController::class, 'index']);

Route::get('/recipes/create', [RecipeController::class, 'create'])->middleware('auth');

Route::post('/recipes', [RecipeController::class, 'store'])->middleware('auth');

Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->middleware('auth');

Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->middleware('auth');

Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->middleware('auth');

Route::get('/recipes/manage', [RecipeController::class, 'manage'])->middleware('auth');

Route::get('/recipes/{recipe}', [RecipeController::class, 'show']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
