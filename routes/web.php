<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubmenuController;

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
    return view('home', ['judul' => 'Beranda']);
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->middleware('guest');

Route::get('/signup', [AuthController::class, 'signup'])->name('signup')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth');
Route::get('/user-add', [UserController::class, 'create'])->middleware('auth');
Route::post('/user/insert', [UserController::class, 'store'])->middleware('auth');
Route::get('/user-edit/{id}', [UserController::class, 'edit'])->middleware('auth');
Route::put('/user/update/{id}', [UserController::class, 'update'])->middleware('auth');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->middleware('auth');
Route::get('/user-deleted', [UserController::class, 'trash'])->middleware('auth');
Route::get('/user/restore/{id}', [UserController::class, 'restore'])->middleware('auth');

Route::get('/role', [RoleController::class, 'show']);
Route::get('/role-add', [RoleController::class, 'create'])->middleware('auth');
Route::post('/role/insert', [RoleController::class, 'store'])->middleware('auth');
Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->middleware('auth');
Route::put('/role/update/{id}', [RoleController::class, 'update'])->middleware('auth');
Route::delete('/role/delete/{id}', [RoleController::class, 'destroy'])->middleware('auth');
Route::get('/role-deleted', [RoleController::class, 'trash'])->middleware('auth');
Route::get('/role/restore/{id}', [RoleController::class, 'restore'])->middleware('auth');

Route::get('/menu', [MenuController::class, 'show']);
Route::get('/menu-add', [MenuController::class, 'create'])->middleware('auth');
Route::post('/menu/insert', [MenuController::class, 'store'])->middleware('auth');
Route::get('/menu-edit/{id}', [MenuController::class, 'edit'])->middleware('auth');
Route::put('/menu/update/{id}', [MenuController::class, 'update'])->middleware('auth');
Route::delete('/menu/delete/{id}', [MenuController::class, 'destroy'])->middleware('auth');
Route::get('/menu-deleted', [MenuController::class, 'trash'])->middleware('auth');
Route::get('/menu/restore/{id}', [MenuController::class, 'restore'])->middleware('auth');

Route::get('/submenu', [SubmenuController::class, 'show']);
Route::get('/submenu-add', [SubmenuController::class, 'create'])->middleware('auth');
Route::post('/submenu/insert', [SubmenuController::class, 'store'])->middleware('auth');
Route::get('/submenu-edit/{id}', [SubmenuController::class, 'edit'])->middleware('auth');
Route::put('/submenu/update/{id}', [SubmenuController::class, 'update'])->middleware('auth');
Route::delete('/submenu/delete/{id}', [SubmenuController::class, 'destroy'])->middleware('auth');
Route::get('/submenu-deleted', [SubmenuController::class, 'trash'])->middleware('auth');
Route::get('/submenu/restore/{id}', [SubmenuController::class, 'restore'])->middleware('auth');

Route::get('/user-change-pic', function () {
    return view('user.change_pic', ['judul' => 'Ganti Foto']);
})->middleware('auth');
Route::put('/user/change-pic/{id}', [UserController::class, 'update_picture'])->middleware('auth');
Route::get('/user-change-pw', function () {
    return view('user.change_pw', ['judul' => 'Ganti Kata Sandi']);
})->middleware('auth');
Route::put('/user/change-pw/{id}', [UserController::class, 'update_password'])->middleware('auth');

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');