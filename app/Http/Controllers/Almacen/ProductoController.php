<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Almacen\Producto;

class ProductoController extends Controller
{
    public function index() {
        $data  = Producto::all();
        return response()->json($data);
    }

    public function show($id) {
        $data  = Producto::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new Producto();

        $data->nombre       =  $request->nombre;
        $data->unidad       =  $request->unidad;
        $data->complemento  =  $request->complemento;
        $data->estado       =  $request->estado;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = Producto::findOrFail($id);

        $data->nombre       =  $request->nombre;
        $data->unidad       =  $request->unidad;
        $data->complemento  =  $request->complemento;
        $data->estado       =  $request->estado;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = Producto::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }
}
