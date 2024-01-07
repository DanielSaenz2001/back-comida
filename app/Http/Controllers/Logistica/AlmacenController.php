<?php

namespace App\Http\Controllers\Logistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistica\Almacen;
use App\Models\Logistica\Establecimiento;
use App\Models\Logistica\Sucursal;

class AlmacenController extends Controller
{
    public function sucursales() {
        $data  = Sucursal::all();
        return response()->json($data);
    }

    public function index() {
        $data  = Almacen::join('sucursales', 'sucursales.id', 'almacenes.sucursal_id')
        ->select('almacenes.*', 'sucursales.direccion as sucursal')->get();

        return response()->json($data);
    }
    
    public function show($id) {
        $data  = Almacen::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new Almacen();

        $data->sucursal_id  =  $request->sucursal_id;
        $data->direccion    =  $request->direccion;
        $data->estado       =  $request->estado;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = Almacen::findOrFail($id);
        $data->sucursal_id  =  $request->sucursal_id;
        $data->direccion    =  $request->direccion;
        $data->estado       =  $request->estado;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = Almacen::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }
}
