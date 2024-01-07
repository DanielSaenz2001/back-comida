<?php

namespace App\Http\Controllers\Logistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistica\Caja;
use App\Models\Logistica\Sucursal;

class CajaController extends Controller
{
    public function sucursales() {
        $data  = Sucursal::all();
        return response()->json($data);
    }

    public function index() {
        $data  = Caja::join('sucursales', 'sucursales.id', 'cajas.sucursal_id')
        ->select('cajas.*', 'sucursales.direccion as sucursal')->get();

        return response()->json($data);
    }
    
    public function show($id) {
        $data  = Caja::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new Caja();

        $data->sucursal_id  =  $request->sucursal_id;
        $data->codigo       =  $request->codigo;
        $data->estado       =  $request->estado;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = Caja::findOrFail($id);
        $data->sucursal_id  =  $request->sucursal_id;
        $data->codigo       =  $request->codigo;
        $data->estado       =  $request->estado;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = Caja::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }
}
