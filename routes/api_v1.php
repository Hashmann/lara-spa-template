<?php


use App\Http\Controllers\Api\V1\Admin\PermissionController;
use App\Http\Controllers\Api\V1\Admin\RoleController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\V1\CurrentUser;
use App\Http\Controllers\Api\V1\LoadImageController;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});


  Route::get('main', MainController::class);



Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('upload', [LoadImageController::class, 'handle']);
    Route::post('upload/del', [LoadImageController::class, 'deleteAvatar']);

  Route::group(['prefix' => 'current'], function () {
    Route::get('user', [CurrentUser::class, 'index']);
    Route::put('user/update', [CurrentUser::class, 'updateCurrentUser']);
    Route::get('role', [CurrentUser::class, 'currentRole']);
  });

  Route::get('logout-user/{userID}', [UserController::class, 'logoutUser']);

  Route::group(['prefix' => 'admin'], function () {
    Route::apiResource('users', UserController::class);

    Route::put('update/role/{userID}', [UserController::class, 'updateRole']);
    Route::put('role/update/{roleID}', [RoleController::class, 'updateRolePermissions']);
    Route::apiResource('roles', RoleController::class);

    Route::get('permissions/all', [PermissionController::class, 'getAllPermissions']);
    Route::apiResource('permissions', PermissionController::class);
  });
});










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


//Route::post('login', [UserController::class, 'login']);
//Route::post('register', [UserController::class, 'register']);
//Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
//
//Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function () {
//    Route::get('/', [AdminController::class, 'index']);
//    Route::get('/', [BookController::class, 'index']);
//    Route::post('add', [BookController::class, 'add']);
//    Route::get('edit/{id}', [BookController::class, 'edit']);
//    Route::post('update/{id}', [BookController::class, 'update']);
//    Route::delete('delete/{id}', [BookController::class, 'delete']);
//});
