<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistica\Almacen;
use App\Models\Almacen\ProductoAlmacen;
use App\Models\Almacen\Producto;

class ProductoAlmacenController extends Controller
{

    public function __construct() {
    }
    
    public function almacenes() {

        $data  = Almacen::join('sucursales', 'sucursales.id', 'almacenes.sucursal_id')
        ->join('establecimientos', 'establecimientos.id', 'sucursales.establecimiento_id')
        ->select('almacenes.*', 'sucursales.direccion as sucursal', 'establecimientos.empresa')->get();

        return response()->json($data);
    }
    
    public function index($id) {

        $almacen  = Almacen::join('sucursales', 'sucursales.id', 'almacenes.sucursal_id')
        ->select('almacenes.*', 'sucursales.direccion as sucursal')
        ->where('almacenes.id', $id)->first();

        $data  = ProductoAlmacen::join('productos', 'productos.id', 'producto_almacen.producto_id')
        ->select('productos.*', 'producto_almacen.id as producto_almacen_id', 'producto_almacen.stock')->get();

        return response()->json([
            'almacen' => $almacen,
            'data' => $data,
        ]);
    }

    public function show($id) {
        $data  = ProductoAlmacen::FindOrFail($id);

        return response()->json($data);
    }

    public function showProductos($id)
    {

        $exits = ProductoAlmacen::join('productos', 'productos.id', 'producto_almacen.producto_id')
        ->where('producto_almacen.almacen_id', $id)
        ->select('productos.*')->get();

        $avoid = [];

        for ($i=0; $i < count($exits); $i++) {
            $avoid[$i] = $exits[$i]['id'];
        }

        $data = Producto::whereNotIn('id', $avoid)->get();

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new ProductoAlmacen();

        $data->producto_id  =  $request->producto_id;
        $data->almacen_id   =  $request->almacen_id;
        $data->stock        =  $request->stock;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = ProductoAlmacen::findOrFail($id);

        $data->stock        =  $request->stock;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = ProductoAlmacen::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }
}
