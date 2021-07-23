<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.index');
});



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/author', [\App\Http\Controllers\Author\AuthorHomeController::class, 'Index']);
});


Route::get('admin/home', [\App\Http\Controllers\Admin\AdminHomeController::class, 'AdminHome'])->name('admin.home')->middleware('is_admin');
