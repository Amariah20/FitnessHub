<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/AboutUs', function () {
    return view('AboutUs');
});

Route::middleware(['auth', 'global.admin'])->group(function () {
    Route::get('/AdminAccess', [App\Http\Controllers\GlobalAdminController::class, 'listUsers'])->name('allUsers');
    Route::post('/AdminAccess/{user}/grant-admin-access', [App\Http\Controllers\GlobalAdminController::class, 'grantAdminAccess'])->name('grantAdminAccess');
    Route::post('/AdminAccess/{user}/revoke-admin-access', [App\Http\Controllers\GlobalAdminController::class, 'revokeAdminAccess'])->name('revokeAdminAccess');
});