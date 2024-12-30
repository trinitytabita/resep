<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\UserController;



Route::prefix('admin')->group(function () {
    Route::resource('menus', MenuController::class);
    Route::resource('categories', CategoryController::class);
    // Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);
    Route::resource('recipes', ResepController::class)->except(['create', 'edit', 'show']);
});

 
Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::get('/category/{name}', [UserController::class, 'show'])->name('user.show');
Route::get('/menu/{id}/detail', [UserController::class, 'detail'])->name('user.detail');
Route::get('/login', [UserController::class, 'loginForm'])->name('admin.login.form');
Route::post('/login', [UserController::class, 'loginSubmit'])->name('admin.login.submit');
Route::get('/logout', function () {
    session()->forget(['admin_logged_in', 'admin_id']);
    return redirect()->route('user.index')->with('message', 'Anda telah logout.');
})->name('admin.logout');

route::get('/tempt',function(){
    return view('user/template');

});