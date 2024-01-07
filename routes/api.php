<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ChangePasswordController;

use App\Http\Controllers\Seguridad\UserController;
use App\Http\Controllers\Seguridad\LinkController;
use App\Http\Controllers\Seguridad\PermisoController;

use App\Http\Controllers\Logistica\EstablecimientoController;
use App\Http\Controllers\Logistica\SucursalController;
use App\Http\Controllers\Logistica\AlmacenController;
use App\Http\Controllers\Logistica\CajaController;
use App\Http\Controllers\Logistica\TipoPagoController;


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

Route::prefix('establecimiento')->middleware(['permisso:LEstablcimiento'])->group(function () {
    Route::get('',                                      [EstablecimientoController::class, 'index']);
    Route::get('{id}',                                  [EstablecimientoController::class, 'show']);
    Route::post('',                                     [EstablecimientoController::class, 'create']);
    Route::put('{id}',                                  [EstablecimientoController::class, 'update']);
    Route::delete('{id}',                               [EstablecimientoController::class, 'destroy']);
});

Route::prefix('sucursal')->middleware(['permisso:LSucursal'])->group(function () {
    Route::get('establecimientos/all',                  [SucursalController::class, 'establecimientos']);
    Route::get('',                                      [SucursalController::class, 'index']);
    Route::get('{id}',                                  [SucursalController::class, 'show']);
    Route::post('',                                     [SucursalController::class, 'create']);
    Route::put('{id}',                                  [SucursalController::class, 'update']);
    Route::delete('{id}',                               [SucursalController::class, 'destroy']);
});

Route::prefix('almacen')->middleware(['permisso:LAlmacen'])->group(function () {
    Route::get('sucursales/all',                        [AlmacenController::class, 'sucursales']);
    Route::get('',                                      [AlmacenController::class, 'index']);
    Route::get('{id}',                                  [AlmacenController::class, 'show']);
    Route::post('',                                     [AlmacenController::class, 'create']);
    Route::put('{id}',                                  [AlmacenController::class, 'update']);
    Route::delete('{id}',                               [AlmacenController::class, 'destroy']);
});

Route::prefix('tipo-pago')->middleware(['permisso:LTPago'])->group(function () {
    Route::get('sucursales/all',                        [TipoPagoController::class, 'sucursales']);
    Route::get('',                                      [TipoPagoController::class, 'index']);
    Route::get('{id}',                                  [TipoPagoController::class, 'show']);
    Route::post('',                                     [TipoPagoController::class, 'create']);
    Route::put('{id}',                                  [TipoPagoController::class, 'update']);
    Route::delete('{id}',                               [TipoPagoController::class, 'destroy']);

    Route::get('suc/{id}',                              [TipoPagoController::class, 'showSucursales']);
    Route::get('addSucursal/{suc}/{tipo}',              [TipoPagoController::class, 'addSucursal']);
    Route::get('dltSucursal/{suc}/{tipo}',              [TipoPagoController::class, 'deleteSucursal']);
});

Route::prefix('caja')->middleware(['permisso:LCaja'])->group(function () {
    Route::get('sucursales/all',                        [CajaController::class, 'sucursales']);
    Route::get('',                                      [CajaController::class, 'index']);
    Route::get('{id}',                                  [CajaController::class, 'show']);
    Route::post('',                                     [CajaController::class, 'create']);
    Route::put('{id}',                                  [CajaController::class, 'update']);
    Route::delete('{id}',                               [CajaController::class, 'destroy']);
});