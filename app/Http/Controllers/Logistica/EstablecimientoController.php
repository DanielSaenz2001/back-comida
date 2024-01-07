<?php

namespace App\Http\Controllers\Logistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistica\Establecimiento;

class EstablecimientoController extends Controller
{
    public function index() {
        $data  = Establecimiento::all();

        return response()->json($data);
    }
    
    public function show($id) {
        $data  = Establecimiento::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new Establecimiento();

        $data->empresa          =  $request->empresa;
        $data->ubicacion        =  $request->ubicacion;
        $data->numero_contacto  =  $request->numero_contacto;
        $data->tipo             =  $request->tipo;
        $data->representante    =  $request->representante;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = Establecimiento::findOrFail($id);

        $data->empresa          =  $request->empresa;
        $data->ubicacion        =  $request->ubicacion;
        $data->numero_contacto  =  $request->numero_contacto;
        $data->tipo             =  $request->tipo;
        $data->representante    =  $request->representante;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = Establecimiento::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }
}
