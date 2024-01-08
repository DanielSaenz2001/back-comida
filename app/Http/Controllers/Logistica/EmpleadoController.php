<?php

namespace App\Http\Controllers\Logistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistica\Sucursal;
use App\Models\Logistica\Empleado;
use App\Models\Logistica\Almacen;
use App\Models\Logistica\Caja;
use App\Models\Seguridad\PermisoUser;
use App\Models\Seguridad\Permiso;
use App\Models\User;

class EmpleadoController extends Controller
{
    public function sucursales() {
        $data  = Sucursal::
        join('establecimientos', 'establecimientos.id', 'sucursales.establecimiento_id')
        ->select('sucursales.*', 'establecimientos.empresa')->get();
        return response()->json($data);
    }

    public function usuarios() {
        $data  = User::join('permiso_users', 'permiso_users.user_id', 'users.id')
        ->join('permisos', 'permisos.id', 'permiso_users.permiso_id')
        ->where('permisos.codigo', 'Empleado')
        ->where('users.estado', true)
        ->select('users.*')->get();
        return response()->json($data);
    }

    public function almacenes($id) {
        $data  = Almacen::where('sucursal_id', $id)->get();
        return response()->json($data);
    }

    public function cajas($id) {
        $data  = Caja::where('sucursal_id', $id)->get();
        return response()->json($data);
    }

    public function index() {
        $data  = Empleado::join('sucursales', 'sucursales.id', 'empleados.sucursal_id')
        ->join('users', 'users.id', 'empleados.user_id')
        ->join('establecimientos', 'establecimientos.id', 'sucursales.establecimiento_id')
        ->select('empleados.*', 'sucursales.direccion as sucursal'
        , 'users.nombres' , 'users.ap_paterno' , 'users.ap_materno', 'establecimientos.empresa')->get();

        return response()->json($data);
    }
    
    public function show($id) {
        $data  = Empleado::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new Empleado();

        $data->sucursal_id  =  $request->sucursal_id;
        $data->user_id      =  $request->user_id;
        $data->caja_id      =  $request->caja_id;
        $data->almacen_id   =  $request->almacen_id;
        $data->isCaja       =  $request->isCaja;
        $data->isAlmacen    =  $request->isAlmacen;
        $data->isMoso       =  $request->isMoso;
        $data->estado       =  $request->estado;
        $data->save();

        if ($request->isCaja) {
            $permiso = Permiso::where('codigo', 'Cajero')->first();
            $puser  = new PermisoUser();
            $puser->permiso_id  = $permiso->id;
            $puser->user_id     = $request->user_id;
            $puser->save();
        }

        if ($request->isAlmacen) {
            $permiso = Permiso::where('codigo', 'Almacenero')->first();
            $puser  = new PermisoUser();
            $puser->permiso_id  = $permiso->id;
            $puser->user_id     = $request->user_id;
            $puser->save();
        }

        if ($request->isMoso) {
            $permiso = Permiso::where('codigo', 'Mozo')->first();
            $puser  = new PermisoUser();
            $puser->permiso_id  = $permiso->id;
            $puser->user_id     = $request->user_id;
            $puser->save();
        }

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = Empleado::findOrFail($id);

        if ($data->isCaja != $request->isCaja) {
            $permiso = Permiso::where('codigo', 'Cajero')->first();
            if ($request->isCaja) {
                $puser  = new PermisoUser();
                $puser->permiso_id  = $permiso->id;
                $puser->user_id     = $request->user_id;
                $puser->save();
            } else {
                $puser  = PermisoUser::where('user_id', $request->user_id)->where('permiso_id', $permiso->id)->first();
                if ($puser) {
                    $puser->delete();
                }
            }
        }

        if ($data->isAlmacen != $request->isAlmacen) {
            $permiso = Permiso::where('codigo', 'Almacenero')->first();
            if ($request->isAlmacen) {
                $puser  = new PermisoUser();
                $puser->permiso_id  = $permiso->id;
                $puser->user_id     = $request->user_id;
                $puser->save();
            } else {
                $puser  = PermisoUser::where('user_id', $request->user_id)->where('permiso_id', $permiso->id)->first();
                if ($puser) {
                    $puser->delete();
                }
            }
        }

        if ($data->isMoso != $request->isMoso) {
            $permiso = Permiso::where('codigo', 'Mozo')->first();
            if ($request->isMoso) {
                $puser  = new PermisoUser();
                $puser->permiso_id  = $permiso->id;
                $puser->user_id     = $request->user_id;
                $puser->save();
            } else {
                $puser  = PermisoUser::where('user_id', $request->user_id)->where('permiso_id', $permiso->id)->first();
                if ($puser) {
                    $puser->delete();
                }
            }
        }

        $data->sucursal_id  =  $request->sucursal_id;
        $data->caja_id      =  $request->caja_id;
        $data->almacen_id   =  $request->almacen_id;
        $data->isCaja       =  $request->isCaja;
        $data->isAlmacen    =  $request->isAlmacen;
        $data->isMoso       =  $request->isMoso;
        $data->estado       =  $request->estado;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = Empleado::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }
}
