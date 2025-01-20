<?php

use App\Http\Controllers\admin\filmController;
use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\homeController as AdminHomeController;
use App\Http\Controllers\anonymous\homeAnonymous;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\author\homeController as AuthorHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\subcriber\filmController as SubcriberFilmController;
use App\Http\Controllers\subcriber\homeController;
use Illuminate\Support\Facades\Route;

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
});

require __DIR__.'/auth.php';

//anonymous
Route::get('anonymous/home', [homeAnonymous::class,'index'])->name('anonymous.home');

//subcriber
Route::get('subcriber/home', [homeController::class,'index'])->name('subcriber.home');
Route::get('subcriber/film', [SubcriberFilmController::class,'index'])->name('subcriber.film');

//author
Route::get('author/home', [AuthorHomeController::class,'index'])->name('author.home');

//admin
Route::get('admin/home', [AdminHomeController::class,'index'])->name('admin.home');
Route::get('admin/film', [filmController::class,'index'])->name('admin.film');
Route::get('admin/input-film', [filmController::class,'create'])->name('admin.input-film');
Route::post('admin/input-film', [filmController::class,'store'])->name('admin.input-film.store');
Route::get('admin/genre', [GenreController::class,'index'])->name('admin.genre');
Route::get('admin/input-genre', [GenreController::class,'create'])->name('admin.input-genre');
Route::post('admin/input-genre', [GenreController::class,'store'])->name('admin.input-genre.store');
Route::get('admin/edit-genre/{id_genre}', [GenreController::class,'edit'])->name('admin.edit-genre');
Route::put('admin/edit-genre/{id_genre}', [GenreController::class, 'update'])->name('admin.edit-input.update');
Route::delete('admin/genre/{id_genre}', [GenreController::class, 'destroy'])->name('admin.genre.delete');


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
