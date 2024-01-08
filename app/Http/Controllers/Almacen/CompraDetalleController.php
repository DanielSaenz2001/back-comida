<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Almacen\CompraDetalle;
use App\Models\Almacen\Compra;
use App\Models\Almacen\ProductoAlmacen;
use App\Models\Logistica\Empleado;
use App\Models\Logistica\Sucursal;
use App\Models\Logistica\Almacen;
use App\Models\Logistica\Proveedor;
use Carbon\Carbon;

class CompraDetalleController extends Controller
{
    private $empleado;
    private $sucursal;

    public function __construct()
    {
        if (!auth()->user()){
            return response()->json(null, 401);
        }
        
        $this->empleado = Empleado::where('user_id', auth()->user()->id)->first();
        $this->sucursal = Sucursal::where('id', $this->empleado->sucursal_id)->first();
    }


    public function productos($id) {

        $data = ProductoAlmacen::join('productos', 'productos.id', 'producto_almacen.producto_id')
        ->where('producto_almacen.almacen_id', $id)
        ->select('productos.*')->get();

        return response()->json($data);
    }
    public function index($id) {
        $data  = Compra::join('proveedores', 'proveedores.id', 'compras.proveedor_id')
        ->join('almacenes', 'almacenes.id', 'compras.almacen_id')
        ->join('empleados', 'empleados.id', 'compras.empleado_id')
        ->join('users', 'users.id', 'empleados.user_id')
        ->join('sucursales', 'sucursales.id', 'compras.sucursal_id')
        ->join('establecimientos', 'establecimientos.id', 'sucursales.establecimiento_id')
        ->where('compras.sucursal_id',  $this->sucursal->id)
        ->select('compras.id', 'compras.fecha', 'compras.estado', 
        'compras.total', 'sucursales.direccion as sucursal', 'establecimientos.empresa', 'almacenes.direccion as almacen',
        'users.nombres', 'users.ap_paterno', 'users.ap_materno', 'proveedores.empresa as proveedor', 'compras.almacen_id')
        ->where('compras.id', $id)->first();

        $detalle = CompraDetalle::join('productos', 'productos.id', 'compra_detalle.producto_id')
        ->where('compra_detalle.compra_id', $id)
        ->select('compra_detalle.*', 'productos.nombre as producto')->get();

        return response()->json([
            'compra' => $data,
            'detalle' => $detalle,
        ]);
    }

    public function show($id) {
        $data  = CompraDetalle::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new CompraDetalle();

        $data->compra_id        =  $request->compra_id;
        $data->producto_id      =  $request->producto_id;
        $data->precio_unitario  =  $request->precio_unitario;
        $data->unidad           =  $request->unidad;
        $data->total            =  $request->precio_unitario * $request->unidad;
        $data->save();

        $detalles = CompraDetalle::where('compra_id', $data->compra_id)->get();

        $suma = 0;
        foreach ($detalles as $detalle) {
            $suma += $detalle->total;
        }

        $compra  = Compra::findOrFail($data->compra_id);
        $compra->total =  $suma;
        $compra->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = CompraDetalle::findOrFail($id);

        $data->producto_id      =  $request->producto_id;
        $data->precio_unitario  =  $request->precio_unitario;
        $data->unidad           =  $request->unidad;
        $data->total            =  $request->precio_unitario * $request->unidad;
        $data->save();


        $detalles = CompraDetalle::where('compra_id', $data->compra_id)->get();

        $suma = 0;
        foreach ($detalles as $detalle) {
            $suma += $detalle->total;
        }

        $compra  = Compra::findOrFail($data->compra_id);
        $compra->total =  $suma;
        $compra->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = CompraDetalle::FindOrFail($id);
        $data->delete();

        $detalles = CompraDetalle::where('compra_id', $data->compra_id)->get();
        $suma = 0;
        foreach ($detalles as $detalle) {
            $suma += $detalle->total;
        }

        $compra  = Compra::findOrFail($data->compra_id);
        $compra->total =  $suma;
        $compra->save();

        
        return response()->json($data, 200);
    }
}
