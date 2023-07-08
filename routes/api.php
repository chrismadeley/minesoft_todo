<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoItemController;
use App\Http\Controllers\TodoListController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/items', [TodoItemController::class, 'index']);

Route::prefix('/item')->group( function () {
	Route::post('/store', [TodoItemController::class, 'store']);
	Route::put('/{id}', [TodoItemController::class, 'update']);
	Route::delete('/{id}', [TodoItemController::class, 'destroy']);
});

Route::post('/todo_list/store', [TodoListController::class, 'store'])->name('todo_list.store');

Route::get('/todo_list', [TodoListController::class, 'index']);

