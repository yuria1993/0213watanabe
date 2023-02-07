<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [TodoController::class, 'content'])->name('dashboard');
    Route::group(['prefix' => 'todo', 'as' => 'todo.'], function () {
        Route::post('/create', [TodoController::class, 'create'])->name('create');
        Route::post('/update', [TodoController::class, 'update'])->name('update');
        Route::post('/delete', [TodoController::class, 'delete'])->name('delete');
        Route::get('/find', [TodoController::class, 'find'])->name('find');
        Route::get('/search', [TodoController::class, 'search'])->name('search');
    });
});



require __DIR__ . '/auth.php';
