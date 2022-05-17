<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RecipeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recipes/{slug}', [RecipeController::class, 'view'])->name('recipes/view');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/recipes', [RecipeController::class, 'index'])->name('recipes');
Route::get('/admin/recipes/add', [RecipeController::class, 'add'])->name('recipes/add');
Route::get('/admin/recipes/edit/{id}', [RecipeController::class, 'edit'])->name('recipes/edit');
Route::post('/admin/recipes/save/{id?}', [RecipeController::class, 'save'])->name('recipes/save');
Route::post('/admin/recipes/saveImage/{id}', [RecipeController::class, 'saveImage'])->name('recipes/saveImage    ');
Route::get('/admin/recipes/deleteImage/{id}', [RecipeController::class, 'deleteImage'])->name('recipes/deleteImage  ');
Route::get('/admin/recipes/delete/{id}', [RecipeController::class, 'delete'])->name('recipes/delete');

Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/admin/categories/add', [CategoryController::class, 'add'])->name('categories/add');
Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories/edit');
Route::post('/admin/categories/save/{id?}', [CategoryController::class, 'save'])->name('categories/save');
Route::post('/admin/categories/saveImage/{id}', [CategoryController::class, 'saveImage'])->name('categories/saveImage    ');
Route::get('/admin/categories/deleteImage/{id}', [CategoryController::class, 'deleteImage'])->name('categories/deleteImage  ');
Route::get('/admin/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories/delete');






