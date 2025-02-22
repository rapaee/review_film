<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\CastingsController;
use App\Http\Controllers\admin\filmController;
use App\Http\Controllers\admin\FilmDetailController;
use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\GenreRelationController;
use App\Http\Controllers\admin\homeController as AdminHomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\anonymous\detailfilmController;
use App\Http\Controllers\anonymous\filmFilterRatingController;
use App\Http\Controllers\anonymous\FilmFilterTerbaruController;
use App\Http\Controllers\anonymous\filmgenreController;
use App\Http\Controllers\anonymous\homeAnonymous;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\author\DetailFilmController as AuthorDetailFilmController;
use App\Http\Controllers\author\FilmController as AuthorFilmController;
use App\Http\Controllers\author\GenreRelationController as AuthorGenreRelationController;
use App\Http\Controllers\author\homeController as AuthorHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\subcriber\detailFilmController as SubcriberDetailFilmController;
use App\Models\Film;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [homeAnonymous::class,'index'])->name('anonymous.home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute yang hanya bisa diakses oleh pengguna dengan peran "admin"
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/home', [AdminHomeController::class,'index'])->name('admin.home');
    Route::get('admin/film-detail/{id}', [FilmDetailController::class,'index'])->name('admin.film-detail');
    Route::post('admin/film-detail', [FilmDetailController::class, 'store'])->name('admin.film-detail.casting');

    Route::get('admin/castings', [CastingsController::class,'index'])->name('admin.castings');
    Route::post('admin/castings', [CastingsController::class,'store'])->name('admin.castings.store');
    Route::get('/admin/castings/{id_castings}', [CastingsController::class, 'editdetaildashboard'])->name('admin.castings.edit');
    Route::put('/admin/castings/{id_castings}', [CastingsController::class, 'updatedetaildashboard'])->name('admin.castings.update');
    Route::delete('/admin/castings/{id_castings}', [CastingsController::class, 'destroy'])->name('admin.castings.delete');
    Route::get('/admin/edit-genre-castings-film-detail/{id}', [CastingsController::class, 'edit'])->name('admin.edit-castings-film-detail.edit');
    Route::put('/admin/edit-genre-castings-film-detail/{id_castings}', [CastingsController::class, 'update'])->name('admin.edit-castings-film-detail.update');

    Route::get('admin/banner', [BannerController::class,'index'])->name('admin.banner');
    Route::post('/admin/banner', [BannerController::class, 'store'])->name('admin.banner.store');
    Route::put('/admin/banner/{id}', [BannerController::class, 'update'])->name('admin.banner.update');
    Route::delete('/admin/banner/{id}', [BannerController::class, 'destroy'])->name('admin.banner.delete');
        
    Route::get('admin/film', [filmController::class,'index'])->name('admin.film');
    Route::post('admin/film', [filmController::class,'store'])->name('admin.input-film.store');
    Route::put('admin/film/{id_film}', [filmController::class, 'update'])->name('admin.edit-film.update');
    Route::delete('admin/film/{id_film}', [filmController::class, 'destroy'])->name('admin.film.delete');

    Route::get('admin/genre', [GenreController::class,'index'])->name('admin.genre');
    Route::post('admin/genre', [GenreController::class,'store'])->name('admin.input-genre.store');
    Route::put('admin/edit-genre/{id_genre}', [GenreController::class, 'update'])->name('admin.edit-genre.update');
    Route::delete('admin/genre/{id_genre}', [GenreController::class, 'destroy'])->name('admin.genre.delete');

    Route::get('admin/genre-relasi', [GenreRelationController::class,'index'])->name('admin.genre-relasi');
    Route::post('admin/genre-relasi', [GenreRelationController::class,'store'])->name('admin.genre-relasi.store');
    Route::get('/admin/edit-genre-relasi/{id}', [GenreRelationController::class, 'edit'])->name('admin.edit-genre-relasi');
    Route::put('admin/edit-genre-relasi/{id}', [GenreRelationController::class, 'update'])->name('admin.edit-genre-relasi.update');
    Route::delete('admin/genre-relasi/{id}', [GenreRelationController::class, 'destroy'])->name('admin.genre-relasi.delete');

    Route::get('admin/user', [UserController::class,'index'])->name('admin.user');
    Route::post('admin/user', [UserController::class,'store'])->name('admin.user.store');
    Route::put('admin/user/{id}', [UserController::class,'update'])->name('admin.user.update');
    Route::delete('admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');

});

// Rute yang hanya bisa diakses oleh pengguna dengan peran "user" atau "admin"
Route::middleware(['auth', 'role:admin,author,subcriber'])->group(function () {
    Route::post('subcriber/detail-film', [SubcriberDetailFilmController::class, 'store'])
        ->name('subcriber.coment');
    Route::delete('subcriber/detail-film/{id}', [SubcriberDetailFilmController::class, 'destroy'])->name('subcriber.comment.detail-film');
    Route::put('anonymous/detail-film/{id}', [detailfilmController::class, 'update'])->name('subcriber.comment.update');
});

Route::middleware('auth')->group(function () {
   
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'addProfilePicture'])->name('profile.upload');
});
require __DIR__.'/auth.php';

//anonymous

Route::get('anonymous/detail-film{id}', [detailfilmController::class,'index'])->name('anonymous.detail-film');
Route::get('anonymous/filter-rating', [filmFilterRatingController::class,'index'])->name('anonymous.filter-rating');
Route::get('anonymous/film-genre/{id}', [filmgenreController::class, 'index'])->name('anonymous.film-genre');
Route::get('anonymous/tahun-rilis/{tahun}', [homeAnonymous::class, 'filterByYear'])->name('anonymous.tahun-rilis');
Route::get('search', [homeAnonymous::class, 'search'])->name('search');
Route::get('anonymous/search-film', [homeAnonymous::class, 'search'])->name('anonymous.film-search');


Route::middleware(['auth', 'role:author'])->group(function () {
  //author
Route::get('author/home', [AuthorHomeController::class,'index'])->name('author.home');
Route::get('author/film', [AuthorFilmController::class,'index'])->name('author.film');
Route::post('author/film', [AuthorFilmController::class,'store'])->name('author.input-film.store');
Route::put('author/film/{id_film}', [AuthorFilmController::class, 'update'])->name('author.edit-film.update');
Route::delete('author/film/{id_film}', [AuthorFilmController::class, 'destroy'])->name('author.film.delete');

Route::get('author/genre-relasi', [AuthorGenreRelationController::class,'index'])->name('author.genre-relasi');
Route::post('author/genre-relasi', [AuthorGenreRelationController::class,'store'])->name('author.genre-relasi.store');
Route::delete('author/genre-relasi/{id}', [AuthorGenreRelationController::class, 'destroy'])->name('author.genre-relasi.delete');
Route::get('author/edit-genre-relasi/{id}', [AuthorGenreRelationController::class, 'edit'])->name('author.edit-genre-relasi');
Route::put('author/edit-genre-relasi/{id}', [AuthorGenreRelationController::class, 'update'])->name('author.edit-genre-relasi.update');

Route::get('author/detail-film/{id}', [AuthorDetailFilmController::class,'index'])->name('author.detail-film');
Route::post('author/detail-film', [AuthorDetailFilmController::class, 'store'])->name('author.detail-film.casting');
Route::get('author/edit-castings-detail-film/{id}', [AuthorDetailFilmController::class, 'edit'])->name('author.edit-castings-detail-film.edit');
Route::put('author/edit-castings-detail-film/{id_castings}', [AuthorDetailFilmController::class, 'update'])->name('author.edit-castings-detail-film.update');



});










Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
