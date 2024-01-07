<?php

namespace App\Http\Controllers\Logistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistica\Proveedor;

class ProveedorController extends Controller
{ 
    public function index() {
        $data  = Proveedor::all();
        return response()->json($data);
    }

    public function show($id) {
        $data  = Proveedor::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new Proveedor();

        $data->empresa      =  $request->empresa;
        $data->ruc          =  $request->ruc;
        $data->representante=  $request->representante;
        $data->email        =  $request->email;
        $data->telefono     =  $request->telefono;
        $data->estado       =  $request->estado;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = Proveedor::findOrFail($id);

        $data->empresa      =  $request->empresa;
        $data->ruc          =  $request->ruc;
        $data->representante=  $request->representante;
        $data->email        =  $request->email;
        $data->telefono     =  $request->telefono;
        $data->estado       =  $request->estado;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = Proveedor::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }
}
