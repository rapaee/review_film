<?php

use App\Http\Controllers\admin\homeController as AdminHomeController;
use App\Http\Controllers\anonymous\homeAnonymous;
use App\Http\Controllers\author\homeController as AuthorHomeController;
use App\Http\Controllers\ProfileController;
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

//author
Route::get('author/home', [AuthorHomeController::class,'index'])->name('author.home');

//admin
Route::get('admin/home', [AdminHomeController::class,'index'])->name('admin.home');
