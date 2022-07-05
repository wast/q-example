<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
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

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/author/{id}', [AuthorController::class, 'show'])->name('author');
    Route::delete('/author/{id}', [AuthorController::class, 'destroy'])->name('delete-author');

    Route::get('/book/create', [BookController::class, 'create'])->name('book-create');
    Route::post('/book', [BookController::class, 'store'])->name('create-book-action');
    Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('delete-book');
});

require __DIR__.'/auth.php';
