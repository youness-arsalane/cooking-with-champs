<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SpoonacularController;
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

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::post('/recipes/create', [RecipeController::class, 'create']);
Route::post('/recipes/{id}/message', [RecipeController::class, 'addComment']);
Route::get('/recipes', [RecipeController::class, 'index']);
Route::get('/recipes/filter/{name}', [RecipeController::class, 'filter']);
Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit']);
Route::put('/recipes/{recipe}', [RecipeController::class, 'update']);
Route::delete('/recipes/{id}', [RecipeController::class, 'destroy']);
Route::get('/recipes/manage', [RecipeController::class, 'manage']);
Route::get('/recipes/{id}', [RecipeController::class, 'show']);

Route::get('/spoonacular/recipes', [SpoonacularController::class, 'recipes']);
Route::post('/spoonacular/sync', [SpoonacularController::class, 'sync']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories/create', [CategoryController::class, 'create']);
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
Route::put('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

/*
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/admin/categories/add', [CategoryController::class, 'add'])->name('categories/add');
Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories/edit');
Route::post('/admin/categories/save/{id?}', [CategoryController::class, 'save'])->name('categories/save');
Route::post('/admin/categories/saveImage/{id}', [CategoryController::class, 'saveImage'])->name('categories/saveImage    ');
Route::get('/admin/categories/deleteImage/{id}', [CategoryController::class, 'deleteImage'])->name('categories/deleteImage  ');
Route::get('/admin/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories/delete');*/

