<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ChapterController;
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
    return view('fontend.index');
});

Auth::routes();



Route::group(['middleware' => ['auth']], function () {

Route::group(['middleware' => ['role:admin']], function () {
Route::resource('/user', UserController::class);
Route::post('/updaterole/{id}', [UserController::class, 'updaterole'])->name('updaterole');
Route::resource('/role', RoleController::class);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('permission:browse home');
Route::resource('/genre', GenreController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/post', PostController::class);
Route::resource('/chapter', ChapterController::class);
Route::get('/createchapter/{id}', [ChapterController::class, 'createchapter'])->name('createchapter')->middleware('permission:add chapter');
Route::post('/publishpost/{id}', [PostController::class, 'publishpost'])->name('publishpost')->middleware('permission:publish post');

});
