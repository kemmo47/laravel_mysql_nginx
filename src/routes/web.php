<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\AccountController;

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

Route::middleware(['checklogin'])->group(function () {
    Route::get('/', [TodosController::class, 'index']);
    Route::get('/todo', [TodosController::class, 'todo']);
    Route::get('/404',[TodosController::class, 'error_page']);

    Route::post('/add-todos', [TodosController::class, 'add_todos']);
    Route::post('/load-todos', [TodosController::class, 'load_todos']);
    Route::post('/edit-todos', [TodosController::class, 'edit_todos']);
    Route::post('/del-todos', [TodosController::class, 'del_todos']);
    Route::post('/done-todos', [TodosController::class, 'done_todos']);
    Route::post('/del-all-todos', [TodosController::class, 'del_all_todos']);
});

Route::get('/login', [AccountController::class, 'login']);
Route::get('/sign-in', [AccountController::class, 'sign_in']);
Route::get('/logout', [AccountController::class, 'logout']);

Route::post('/login-todo', [AccountController::class, 'login_todo']);
Route::post('/sign-in-todo', [AccountController::class, 'sign_in_todo']);