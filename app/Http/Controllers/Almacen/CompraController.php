<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Almacen\Compra;
use App\Models\Logistica\Empleado;
use App\Models\Logistica\Sucursal;
use App\Models\Logistica\Almacen;
use App\Models\Logistica\Proveedor;
use Carbon\Carbon;

class CompraController extends Controller
{
    private $empleado;
    private $sucursal;

    public function __construct()
    {
        $this->empleado = Empleado::where('user_id', auth()->user()->id)->first();
        $this->sucursal = Sucursal::where('id', $this->empleado->sucursal_id)->first();
    }

    public function almacenes() {
        $data  = Almacen::where('sucursal_id', $this->empleado->sucursal_id)->get();
        return response()->json($data);
    }


    public function proveedores() {
        $data  = Proveedor::all();
        return response()->json($data);
    }

    public function index() {
        $data  = Compra::join('proveedores', 'proveedores.id', 'compras.proveedor_id')
        ->join('almacenes', 'almacenes.id', 'compras.almacen_id')
        ->join('empleados', 'empleados.id', 'compras.empleado_id')
        ->join('users', 'users.id', 'empleados.user_id')
        ->join('sucursales', 'sucursales.id', 'compras.sucursal_id')
        ->join('establecimientos', 'establecimientos.id', 'sucursales.establecimiento_id')
        ->where('compras.sucursal_id',  $this->sucursal->id)
        ->select('compras.id', 'compras.fecha', 'compras.estado', 
        'compras.total', 'sucursales.direccion as sucursal', 'establecimientos.empresa', 'almacenes.direccion as almacen',
        'users.nombres', 'users.ap_paterno', 'users.ap_materno', 'proveedores.empresa as proveedor', 'almacenes.id as almacen_id')->get();
        return response()->json($data);
    }

    public function show($id) {
        $data  = Compra::FindOrFail($id);

        return response()->json($data);
    }

    public function create(Request $request) {
        $data = new Compra();

        $data->proveedor_id =  $request->proveedor_id;
        $data->almacen_id   =  $request->almacen_id;
        $data->sucursal_id  =  $this->empleado->sucursal_id;
        $data->empleado_id  =  $this->empleado->id;
        $data->fecha        =  Carbon::now();
        $data->total        =  0;
        $data->estado       =  0;
        $data->save();

        return response()->json($data, 200);
    }

    public function update($id, Request $request) {
        $data  = Compra::findOrFail($id);

        $data->proveedor_id =  $request->proveedor_id;
        $data->almacen_id   =  $request->almacen_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data   = Compra::FindOrFail($id);
        $data->delete();
        
        return response()->json($data, 200);
    }

    public function close($id) {
        $data  = Compra::findOrFail($id);
        $data->estado =  1;
        $data->save();

        return response()->json($data, 200);
    }
}
