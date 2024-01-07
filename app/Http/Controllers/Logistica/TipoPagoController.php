<?php

namespace App\Http\Controllers\Logistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistica\TipoPagoSucursal;
use App\Models\Logistica\TipoPago;
use App\Models\Logistica\Establecimiento;
use App\Models\Logistica\Sucursal;

class TipoPagoController extends Controller
{
    public function sucursales() {
        $data  = Sucursal::all();
        return response()->json($data);
    }

    public function index() {
        $data  = TipoPago::all();
        return response()->json($data);
    }
    
    public function show($id) {
        $data  = TipoPago::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new TipoPago();

        $data->sucursal_id  =  $request->sucursal_id;
        $data->nombre    =  $request->nombre;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = TipoPago::findOrFail($id);
        $data->sucursal_id  =  $request->sucursal_id;
        $data->nombre       =  $request->nombre;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = TipoPago::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }
}
