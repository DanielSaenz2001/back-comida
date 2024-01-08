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
use App\Http\Controllers\Logistica\EmpleadoController;
use App\Http\Controllers\Logistica\ProveedorController;

use App\Http\Controllers\Almacen\ProductoController;
use App\Http\Controllers\Almacen\ProductoAlmacenController;
use App\Http\Controllers\Almacen\CompraController;
use App\Http\Controllers\Almacen\CompraDetalleController;


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
    Route::get('addSucursal/{tipo}/{suc}',              [TipoPagoController::class, 'addSucursal']);
    Route::get('dltSucursal/{tipo}/{suc}',              [TipoPagoController::class, 'deleteSucursal']);
});

Route::prefix('caja')->middleware(['permisso:LCaja'])->group(function () {
    Route::get('sucursales/all',                        [CajaController::class, 'sucursales']);
    Route::get('',                                      [CajaController::class, 'index']);
    Route::get('{id}',                                  [CajaController::class, 'show']);
    Route::post('',                                     [CajaController::class, 'create']);
    Route::put('{id}',                                  [CajaController::class, 'update']);
    Route::delete('{id}',                               [CajaController::class, 'destroy']);
});

Route::prefix('empleado')->middleware(['permisso:LEmpleado'])->group(function () {
    Route::get('sucursales/all',                        [EmpleadoController::class, 'sucursales']);
    Route::get('usuarios/all',                          [EmpleadoController::class, 'usuarios']);
    Route::get('almacenes/{id}',                        [EmpleadoController::class, 'almacenes']);
    Route::get('cajas/{id}',                            [EmpleadoController::class, 'cajas']);
    Route::get('',                                      [EmpleadoController::class, 'index']);
    Route::get('{id}',                                  [EmpleadoController::class, 'show']);
    Route::post('',                                     [EmpleadoController::class, 'create']);
    Route::put('{id}',                                  [EmpleadoController::class, 'update']);
    Route::delete('{id}',                               [EmpleadoController::class, 'destroy']);
});

Route::prefix('proveedor')->middleware(['permisso:LProveedor'])->group(function () {
    Route::get('',                                      [ProveedorController::class, 'index']);
    Route::get('{id}',                                  [ProveedorController::class, 'show']);
    Route::post('',                                     [ProveedorController::class, 'create']);
    Route::put('{id}',                                  [ProveedorController::class, 'update']);
    Route::delete('{id}',                               [ProveedorController::class, 'destroy']);
});

Route::prefix('producto')->middleware(['permisso:AProductos'])->group(function () {
    Route::get('',                                      [ProductoController::class, 'index']);
    Route::get('{id}',                                  [ProductoController::class, 'show']);
    Route::post('',                                     [ProductoController::class, 'create']);
    Route::put('{id}',                                  [ProductoController::class, 'update']);
    Route::delete('{id}',                               [ProductoController::class, 'destroy']);
});

Route::prefix('gestion-almacen')->middleware(['permisso:AAlmacen'])->group(function () {
    Route::get('almacenes/all',                         [ProductoAlmacenController::class, 'almacenes']);
    Route::get('{id}',                                  [ProductoAlmacenController::class, 'index']);
    Route::get('get/{id}',                              [ProductoAlmacenController::class, 'show']);
    Route::get('productos/{id}',                        [ProductoAlmacenController::class, 'showProductos']);
    Route::post('',                                     [ProductoAlmacenController::class, 'create']);
    Route::put('{id}',                                  [ProductoAlmacenController::class, 'update']);
    Route::delete('{id}',                               [ProductoAlmacenController::class, 'destroy']);
});

Route::prefix('compra')->middleware(['permisso:Almacenero'])->group(function () {
    Route::get('almacenes/all',                         [CompraController::class, 'almacenes']);
    Route::get('proveedores/all',                       [CompraController::class, 'proveedores']);
    Route::get('',                                      [CompraController::class, 'index']);
    Route::get('close/{id}',                            [CompraController::class, 'close']);
    Route::post('',                                     [CompraController::class, 'create']);
    Route::put('{id}',                                  [CompraController::class, 'update']);
    Route::delete('{id}',                               [CompraController::class, 'destroy']);
});

Route::prefix('compra-detalle')->middleware(['permisso:Almacenero'])->group(function () {
    Route::get('productos/{id}',                        [CompraDetalleController::class, 'productos']);
    Route::get('{id}',                                  [CompraDetalleController::class, 'index']);
    Route::get('get/{id}',                              [CompraDetalleController::class, 'show']);
    Route::post('',                                     [CompraDetalleController::class, 'create']);
    Route::put('{id}',                                  [CompraDetalleController::class, 'update']);
    Route::delete('{id}',                               [CompraDetalleController::class, 'destroy']);
});

