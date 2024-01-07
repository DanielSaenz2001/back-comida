<?php

namespace App\Http\Controllers\Logistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistica\Sucursal;
use App\Models\Logistica\Establecimiento;

class SucursalController extends Controller
{
    public function establecimientos() {
        $data  = Establecimiento::all();

        return response()->json($data);
    }

    public function index() {
        $data  = Sucursal::join('establecimientos', 'establecimientos.id', 'sucursales.establecimiento_id')
        ->select('sucursales.*', 'establecimientos.empresa')->get();

        return response()->json($data);
    }
    
    public function show($id) {
        $data  = Sucursal::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new Sucursal();

        $data->establecimiento_id   =  $request->establecimiento_id;
        $data->direccion            =  $request->direccion;
        $data->representante        =  $request->representante;
        $data->administrador        =  $request->administrador;
        $data->coordinador          =  $request->coordinador;
        $data->telefono             =  $request->telefono;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = Sucursal::findOrFail($id);
        
        $data->establecimiento_id   =  $request->establecimiento_id;
        $data->direccion            =  $request->direccion;
        $data->representante        =  $request->representante;
        $data->administrador        =  $request->administrador;
        $data->coordinador          =  $request->coordinador;
        $data->telefono             =  $request->telefono;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = Sucursal::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }
}
