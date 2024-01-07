<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ChangePasswordController;

use App\Http\Controllers\Seguridad\UserController;
use App\Http\Controllers\Seguridad\LinkController;
use App\Http\Controllers\Seguridad\PermisoController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
    ], function () {
    Route::post('login',                                [AuthController::class, 'login']);
    Route::get('me',                                    [AuthController::class, 'me']);
    Route::post('logout',                               [AuthController::class, 'logout']);
    Route::post('sendPasswordResetLink',                [ResetPasswordController::class, 'sendEmail']);
    Route::get('resetPassword/{id}',                    [ChangePasswordController::class, 'process']);
});

Route::prefix('usuario')->middleware(['permisso:SUsuarios'])->group(function () {
    Route::get('',                                      [UserController::class, 'index']);
    Route::get('{id}',                                  [UserController::class, 'show']);
    Route::get('permiso/{id}',                          [UserController::class, 'showPermiso']);
    Route::get('filtro/{p}/{m}/{n}/{d}',                [UserController::class, 'filtro']);
    Route::post('',                                     [UserController::class, 'create']);
    Route::put('{id}',                                  [UserController::class, 'update']);
    Route::get('estado/{id}',                           [UserController::class, 'estado']);
    Route::get('addPermiso/{user}/{per}',               [UserController::class, 'addPermiso']);
    Route::get('dltPermiso/{user}/{per}',               [UserController::class, 'deletePermiso']);
});


Route::prefix('link')->middleware(['permisso:SRutas'])->group(function () {
    Route::get('',                                      [LinkController::class, 'index']);
    Route::get('{id}',                                  [LinkController::class, 'show']);
    Route::get('children/{id}',                         [LinkController::class, 'showChildren']);
    Route::post('',                                     [LinkController::class, 'create']);
    Route::put('{id}',                                  [LinkController::class, 'update']);
    Route::delete('{id}',                               [LinkController::class, 'destroy']);
    Route::get('addPermiso/{link}/{per}',               [LinkController::class, 'addPermiso']);
    Route::get('dltPermiso/{link}/{per}',               [LinkController::class, 'deletePermiso']);
});

Route::prefix('permiso')->middleware(['permisso:SPermisos'])->group(function () {
    Route::get('',                                      [PermisoController::class, 'index']);
    Route::get('{id}',                                  [PermisoController::class, 'show']);
    Route::post('',                                     [PermisoController::class, 'create']);
    Route::put('{id}',                                  [PermisoController::class, 'update']);
    Route::delete('{id}',                               [PermisoController::class, 'destroy']);
});