<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/authors',[AuthorController::class, 'index'])->name('author.index');
    Route::get('/author-delete/{id}',[AuthorController::class, 'destroy'])->name('author.delete');
    Route::get('/author-show/{id}',[AuthorController::class, 'show'])->name('author.show');
    Route::get('create-book',[BookController::class,'create'])->name('book.create');
    Route::post('book',[BookController::class,'store'])->name('book.store');
    Route::get('/book-delete/{id}',[BookController::class, 'destroy'])->name('book.delete');
});

require __DIR__.'/auth.php';


