<?php

namespace App\Http\Controllers\Logistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistica\TipoPagoSucursal;
use App\Models\Logistica\TipoPago;
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

    public function showSucursales($id)
    {
        $data       = TipoPago::findOrFail($id);

        $exits = TipoPagoSucursal::join('sucursales', 'sucursales.id', 'tipos_pago_surcursales.sucursal_id')
        ->where('tipos_pago_surcursales.tipo_pago_id', $id)
        ->select('sucursales.*')->get();

        $avoid = [];

        for ($i=0; $i < count($exits); $i++) {
            $avoid[$i] = $exits[$i]['id'];
        }

        $permisos = Sucursal::whereNotIn('id', $avoid)->get();

        $data->exits        = $exits;
        $data->permisos     = $permisos;

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new TipoPago();

        $data->nombre    =  $request->nombre;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = TipoPago::findOrFail($id);
        $data->nombre       =  $request->nombre;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = TipoPago::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }

    /*  Sucursal */

    public function addSucursal($tipo_pago_id, $sucursal_id){
        $plink  = new TipoPagoSucursal();

        $plink->sucursal_id  = $sucursal_id;
        $plink->tipo_pago_id     = $tipo_pago_id;
        $plink->save();

        return $this->showSucursales($tipo_pago_id);
    }

    public function deleteSucursal($tipo_pago_id, $sucursal_id){
        $plink  = TipoPagoSucursal::where('tipo_pago_id', $tipo_pago_id)->where('sucursal_id', $sucursal_id)->first();
        if($plink){
            $plink->delete();
        }else{
            return response()->json([
                'message'   => 'No se encontro ese registro.'
            ], 404);
        }

        return $this->showSucursales($tipo_pago_id);
    }
}
