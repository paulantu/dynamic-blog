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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'Index']);
Route::get('/blog', [\App\Http\Controllers\HomeController::class, 'ShowAllBlogPost']);
Route::get('/blog/{slug}', [\App\Http\Controllers\HomeController::class, 'ViewPostDetails']);
Route::post('/comment/{id}', [\App\Http\Controllers\HomeController::class, 'CommentStore']);


//Author area

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/author', [\App\Http\Controllers\Author\AuthorHomeController::class, 'Index']);


    Route::get('/author/blog', [\App\Http\Controllers\Author\AuthorHomeController::class, 'ShowAllBlogPost']);
    Route::get('/author/blog/{slug}', [\App\Http\Controllers\Author\AuthorHomeController::class, 'ViewPostDetails']);
    Route::post('/author/comment/{id}', [\App\Http\Controllers\Author\AuthorHomeController::class, 'CommentStore']);
    Route::get('/author/my-blog', [\App\Http\Controllers\Author\AuthorHomeController::class, 'DisplayMyBlog']);





    Route::get('author/add/blog-post', [\App\Http\Controllers\Author\AuthorHomeController::class, 'AddPost']);
    Route::get('/authorSubCatdependency/{cat_id}', [\App\Http\Controllers\Author\AuthorHomeController::class, 'subCatdependency']);
    Route::post('author/blog-post/store', [\App\Http\Controllers\Author\AuthorHomeController::class, 'Store']);
    Route::get('author/view/blog-post/{id}', [\App\Http\Controllers\Author\AuthorHomeController::class, 'View']);
    Route::get('author/edit/blog-post/{id}', [\App\Http\Controllers\Author\AuthorHomeController::class, 'Edit']);
    Route::put('author/update/blog-post/{id}', [\App\Http\Controllers\Author\AuthorHomeController::class, 'Update']);
    Route::get('author/delete/blog-post/{id}', [\App\Http\Controllers\Author\AuthorHomeController::class, 'Destroy']);
    Route::get('/changeAuthorBlogStatus', [\App\Http\Controllers\Author\AuthorHomeController::class, 'changeStatus']);
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
Route::get('admin/add/blog-post', [\App\Http\Controllers\Admin\BlogController::class, 'AddPost'])->middleware('is_admin');
Route::post('admin/blog-post/store', [\App\Http\Controllers\Admin\BlogController::class, 'Store'])->middleware('is_admin');
Route::get('admin/view/blog-post/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'View'])->middleware('is_admin');
Route::get('admin/edit/blog-post/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'Edit'])->middleware('is_admin');
Route::put('admin/update/blog-post/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'Update'])->middleware('is_admin');
Route::get('admin/delete/blog-post/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'Destroy'])->middleware('is_admin');
Route::get('/changeBlogStatus', [\App\Http\Controllers\Admin\BlogController::class, 'changeStatus'])->middleware('is_admin');
Route::get('/subCatdependency/{cat_id}', [\App\Http\Controllers\Admin\BlogController::class, 'subCatdependency'])->middleware('is_admin');



Route::get('admin/manage-role', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Index'])->name('admin.home')->middleware('is_admin');
Route::post('admin/role/store', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Store'])->middleware('is_admin');
Route::get('admin/edit/role/{id}', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Edit'])->middleware('is_admin');
Route::put('admin/role/update/{id}', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Update'])->middleware('is_admin');
Route::get('admin/delete/role/{id}', [\App\Http\Controllers\Admin\ManageRoleController::class, 'Destroy'])->middleware('is_admin');




Route::get('admin/manage-user', [\App\Http\Controllers\Admin\ManageUserController::class, 'Index'])->name('admin.home')->middleware('is_admin');
Route::post('admin/change-user-role/{id}', [\App\Http\Controllers\Admin\ManageUserController::class, 'userRoleUpdate'])->middleware('is_admin');
Route::get('/changeStatus', [\App\Http\Controllers\Admin\ManageUserController::class, 'changeStatus'])->middleware('is_admin');
Route::get('admin/delete/user/{id}', [\App\Http\Controllers\Admin\ManageUserController::class, 'Destroy'])->middleware('is_admin');





Route::get('admin/search',[\App\Http\Controllers\SearchController::class, 'Index'])->middleware('is_admin');
Route::get('admin/search/results',[\App\Http\Controllers\SearchController::class, 'AdminAutoSearch'])->name('admin.search.results')->middleware('is_admin');
