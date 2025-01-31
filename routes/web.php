<?php

use App\Http\Controllers\admin\filmController;
use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\GenreRelationController;
use App\Http\Controllers\admin\homeController as AdminHomeController;
use App\Http\Controllers\anonymous\detailfilmController;
use App\Http\Controllers\anonymous\FilmFilterTerbaruController;
use App\Http\Controllers\anonymous\homeAnonymous;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\author\homeController as AuthorHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\subcriber\detailFilmController as SubcriberDetailFilmController;
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
Route::get('anonymous/detail-film{id}', [detailfilmController::class,'index'])->name('anonymous.detail-film');
Route::get('anonymous/filter-terbaru', [FilmFilterTerbaruController::class,'index'])->name('anonymous.filter-terbaru');

//subcriber
Route::get('subcriber/home', [homeController::class,'index'])->name('subcriber.home');
Route::get('subcriber/film', [SubcriberFilmController::class,'index'])->name('subcriber.film');
Route::get('subcriber/detail-film{id}', [SubcriberDetailFilmController::class,'index'])->name('subcriber.detail-film');
Route::post('subcriber/detail-film', [SubcriberDetailFilmController::class, 'store'])->middleware('auth')->name('subcriber.coment');




//author
Route::get('author/home', [AuthorHomeController::class,'index'])->name('author.home');

//admin
Route::get('admin/home', [AdminHomeController::class,'index'])->name('admin.home');
Route::get('admin/film', [filmController::class,'index'])->name('admin.film');
Route::post('admin/film', [filmController::class,'store'])->name('admin.input-film.store');
Route::put('admin/edit-film/{id_film}', [filmController::class, 'update'])->name('admin.edit-film.update');
Route::delete('admin/film/{id_film}', [filmController::class, 'destroy'])->name('admin.film.delete');

Route::get('admin/genre', [GenreController::class,'index'])->name('admin.genre');
Route::post('admin/input-genre', [GenreController::class,'store'])->name('admin.input-genre.store');
Route::put('admin/edit-genre/{id_genre}', [GenreController::class, 'update'])->name('admin.edit-genre.update');
Route::delete('admin/genre/{id_genre}', [GenreController::class, 'destroy'])->name('admin.genre.delete');

Route::get('admin/genre-relasi', [GenreRelationController::class,'index'])->name('admin.genre-relasi');
Route::post('admin/genre-relasi', [GenreRelationController::class,'store'])->name('admin.genre-relasi.store');
Route::put('admin/genre-relasi/{id}', [GenreRelationController::class, 'update'])->name('admin.genre-relasi.update');
Route::delete('admin/genre-relasi/{id}', [GenreRelationController::class, 'destroy'])->name('admin.genre-relasi.delete');


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
