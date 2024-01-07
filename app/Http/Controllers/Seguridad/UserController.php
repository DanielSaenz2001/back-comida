<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seguridad\PermisoUser;
use App\Models\Seguridad\Permiso;
use App\Models\User;

class UserController extends Controller
{
    public function index(){

        $resquest  = User::paginate(20);

        return response()->json($resquest);
    }

    public function show($id){

        $usuario = User::findOrFail($id);

        return response()->json($usuario);
    }

    public function showPermiso($id){

        $permisosUsuarios = PermisoUser::join('permisos', 'permisos.id', 'permiso_users.permiso_id')
        ->where('permiso_users.user_id', $id)
        ->select('permisos.*')->get();

        $permisosAvoid = [];

        for ($i=0; $i < count($permisosUsuarios); $i++) {
            $permisosAvoid[$i] = $permisosUsuarios[$i]['id'];
        }

        $permisos = Permiso::whereNotIn('id', $permisosAvoid)->where('activo', true)->get();

        return response()->json([
            'puser' => $permisosUsuarios,
            'permi' => $permisos
        ]);

    }

    public function filtro($paterno, $materno, $nombres, $dni){

        if($paterno == "null"){
            $paterno = null;
        }
        if($materno == "null"){
            $materno = null;
        }
        if($nombres == "null"){
            $nombres = null;
        }
        if($dni     == "null"){
            $dni     = null;
        }

        $usuario = User::paterno($paterno)->materno($materno)
        ->nombre($nombres)->dni($dni)->paginate(20);

        return response()->json($usuario);

    }

    public function create(Request $request){
        $res = User::dni($request->dni)->first();
        if($res){
            return response()->json(array(
                'message'   =>  "Ya hay un Usuario registrado con ese dni."
            ), 400);
        }

        $res = User::user($request->username)->first();
        if($res){
            return response()->json(array(
                'message'   =>  "Ya hay un Usuario registrado."
            ), 400);
        }

        $res = User::email($request->email)->first();
        if($res){
            return response()->json(array(
                'message'   =>  "Ya hay un Usuario registrado con ese correo."
            ), 400);
        }

        $usuario = new User();
        $usuario->nombres           = $request->nombres;
        $usuario->ap_paterno        = $request->ap_paterno;
        $usuario->ap_materno        = $request->ap_materno;
        $usuario->direccion         = $request->direccion;
        $usuario->dni               = $request->dni;
        $usuario->sexo              = $request->sexo;
        $usuario->email             = $request->email;
        $usuario->fec_nacimiento    = $request->fec_nacimiento;
        $usuario->celular           = $request->celular;
        $usuario->username          = $request->username;
        $usuario->password          = $request->dni;
        $usuario->estado            = $request->estado;
        $usuario->save();

        return response()->json(array(
            'message'   =>  "Usuario creado con exito."
        ), 201);
    }

    public function update($id,Request $request){
        $usuario = User::findOrFail($id);

        if($usuario->dni !== $request->dni){
            $res = User::dni($request->dni)->first();
            if($res){
                return response()->json(array(
                    'message'   =>  "Ya hay un Usuario registrado con ese dni."
                ), 400);
            }
        }
        if($usuario->usuario !== $request->usuario){
            $res = User::user($request->usuario)->first();
            if($res){
                return response()->json(array(
                    'message'   =>  "Ya hay un Usuario registrado."
                ), 400);
            }
        }
        if($usuario->email !== $request->email){
            $res = User::email($request->email)->first();
            if($res){
                return response()->json(array(
                    'message'   =>  "Ya hay un Usuario registrado con ese correo."
                ), 400);
            }
        }



        $usuario = User::findOrFail($id);
        $usuario->dni               = $request->dni;
        $usuario->nombres           = $request->nombres;
        $usuario->ap_paterno        = $request->ap_paterno;
        $usuario->ap_materno        = $request->ap_materno;
        $usuario->direccion         = $request->direccion;
        $usuario->sexo              = $request->sexo;
        $usuario->email             = $request->email;
        $usuario->fec_nacimiento    = $request->fec_nacimiento;
        $usuario->celular           = $request->celular;
        $usuario->estado            = $request->estado;
        $usuario->username          = $request->username;
        $usuario->save();

        return response()->json(array(
            'message'   => "Usuario Actualizado."
        ), 200);
    }

    public function estado($id){

        $usuario = User::findOrFail($id);

        $usuario->estado = !$usuario->estado;

        $usuario->save();

        return response()->json($usuario);
    }

    public function addPermiso($id_user, $id_permiso){
        $puser  = new PermisoUser();

        $puser->permiso_id  = $id_permiso;
        $puser->user_id     = $id_user;
        $puser->save();

        return response()->json(array(
            'message'   =>  "Permiso Actualizado."
        ), 200);
    }

    public function deletePermiso($id_user, $id_permiso){
        $puser  = PermisoUser::where('user_id', $id_user)->where('permiso_id', $id_permiso)->first();
        if($puser){
            $puser->delete();
        }else{
            return response()->json([
                'status'    => 'Sin Coincidencia',
                'message'   => 'No se encontro ese registro.'
            ], 404);
        }

        return response()->json(array(
            'message'   =>  "Permiso Actualizado."
        ), 200);
    }
}
