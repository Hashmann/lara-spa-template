<?php

use App\Http\Controllers\Api\V1\Admin\AdminController;
use Illuminate\Support\Facades\Auth;
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

//Route::group(['prefix' => 'tags'], function () {
//    Route::get('/', \App\Http\Controllers\Tag\IndexController::class)->name('tag.index');
//    Route::get('/create', \App\Http\Controllers\Tag\CreateController::class)->name('tag.create');
//    Route::post('/', \App\Http\Controllers\Tag\StoreController::class)->name('tag.store');
//    Route::get('/{slug}/edit', \App\Http\Controllers\Tag\EditController::class)->name('tag.edit');
//    Route::get('/{slug}', \App\Http\Controllers\Tag\ShowController::class)->name('tag.show');
//    Route::patch('/{slug}', \App\Http\Controllers\Tag\UpdateController::class)->name('tag.update');
//    Route::delete('/{slug}', \App\Http\Controllers\Tag\DeleteController::class)->name('tag.delete');
//
//    Route::post('/{slug}/restore', \App\Http\Controllers\Tag\RestoreController::class)->name('tag.restore');
//    Route::post('/{slug}', \App\Http\Controllers\Tag\ForceDeleteController::class)->name('tag.force_delete');
//});

Route::get('{any}', function () {
    return view('index');
})->where('any', '.*');

Auth::routes();

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');
//Route::get('/admin', AdminController::class);
