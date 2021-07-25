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


//Author area

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/author', [\App\Http\Controllers\Author\AuthorHomeController::class, 'Index']);
});



















//Admin Routes area

Route::get('admin/home', [\App\Http\Controllers\Admin\AdminHomeController::class, 'AdminHome'])->name('admin.home')->middleware('is_admin');




Route::get('admin/category', [\App\Http\Controllers\Admin\CategoryController::class, 'Index'])->name('admin.task')->middleware('is_admin');
Route::post('admin/category/store', [\App\Http\Controllers\Admin\CategoryController::class, 'Store'])->middleware('is_admin');
Route::get('admin/edit/category/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'Edit'])->middleware('is_admin');
Route::put('admin/update/category/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'Update'])->middleware('is_admin');
Route::get('admin/delete/category/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'Destroy'])->middleware('is_admin');
Route::get('/changeCatStatus', [\App\Http\Controllers\Admin\CategoryController::class, 'changeStatus'])->middleware('is_admin');






Route::get('admin/sub-category', [\App\Http\Controllers\Admin\SubCategoryController::class, 'Index'])->name('admin.task')->middleware('is_admin');
Route::post('admin/sub-category/store', [\App\Http\Controllers\Admin\SubCategoryController::class, 'Store'])->middleware('is_admin');
Route::get('admin/edit/sub-category/{id}', [\App\Http\Controllers\Admin\SubCategoryController::class, 'Edit'])->middleware('is_admin');
Route::put('admin/update/sub-category/{id}', [\App\Http\Controllers\Admin\SubCategoryController::class, 'Update'])->middleware('is_admin');
Route::get('admin/delete/sub-category/{id}', [\App\Http\Controllers\Admin\SubCategoryController::class, 'Destroy'])->middleware('is_admin');
Route::get('/changeSubCatStatus', [\App\Http\Controllers\Admin\SubCategoryController::class, 'changeStatus'])->middleware('is_admin');




Route::get('admin/blog', [\App\Http\Controllers\Admin\BlogController::class, 'Index'])->name('admin.home')->middleware('is_admin');




Route::get('admin/manage-role', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Index'])->name('admin.home')->middleware('is_admin');
Route::post('admin/role/store', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Store'])->middleware('is_admin');
Route::get('admin/edit/role/{id}', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Edit'])->middleware('is_admin');
Route::put('admin/role/update/{id}', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Update'])->middleware('is_admin');
Route::get('admin/delete/role/{id}', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Destroy'])->middleware('is_admin');




Route::get('admin/manage-user', [\App\Http\Controllers\Admin\ManageUserController::class, 'Index'])->name('admin.home')->middleware('is_admin');
Route::post('admin/change-user-role/{id}', [\App\Http\Controllers\Admin\ManageUserController::class, 'userRoleUpdate'])->middleware('is_admin');
Route::get('/changeStatus', [\App\Http\Controllers\Admin\ManageUserController::class, 'changeStatus'])->middleware('is_admin');
Route::get('admin/delete/user/{id}', [\App\Http\Controllers\Admin\ManageUserController::class, 'Destroy'])->middleware('is_admin');
