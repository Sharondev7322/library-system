<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('books', BookController::class);
Route::resource('students', StudentController::class);
Route::resource('borrowings', BorrowingController::class);

Route::post('borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
    ->name('borrowings.return');
