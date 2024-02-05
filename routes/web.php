<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
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

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/user-add', [UserController::class, 'create']);
Route::post('/user/insert', [UserController::class, 'store']);
Route::get('/user-edit/{id}', [UserController::class, 'edit']);
Route::put('/user/update/{id}', [UserController::class, 'update']);

Route::get('/role', [RoleController::class, 'show']);
Route::get('/role-add', [RoleController::class, 'create']);
Route::post('/role/insert', [RoleController::class, 'store']);
Route::get('/role-edit/{id}', [RoleController::class, 'edit']);
Route::put('/role/update/{id}', [RoleController::class, 'update']);

Route::get('/menu', [MenuController::class, 'show']);
Route::get('/menu-add', [MenuController::class, 'create']);
Route::post('/menu/insert', [MenuController::class, 'store']);
Route::get('/menu-edit/{id}', [MenuController::class, 'edit']);
Route::put('/menu/update/{id}', [MenuController::class, 'update']);

Route::get('/log', [LogController::class, 'show']);

Route::get('/submenu', [SubmenuController::class, 'show']);
Route::get('/submenu-add', [SubmenuController::class, 'create']);
Route::post('/submenu/insert', [SubmenuController::class, 'store']);
Route::get('/submenu-edit/{id}', [SubmenuController::class, 'edit']);
Route::put('/submenu/update/{id}', [SubmenuController::class, 'update']);