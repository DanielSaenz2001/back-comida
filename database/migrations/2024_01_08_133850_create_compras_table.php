<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('proveedor_id');
            $table->unsignedInteger('almacen_id');
            $table->unsignedInteger('sucursal_id');
            $table->unsignedInteger('empleado_id');

            $table->date('fecha');

            $table->float('total');

            $table->tinyInteger('estado');

            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('almacen_id')->references('id')->on('almacenes');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->foreign('empleado_id')->references('id')->on('empleados');

            $table->charset   = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('compras')->insert(
            [
                [
                    'proveedor_id' => 1,
                    'almacen_id' => 1,
                    'sucursal_id' => 1,
                    'empleado_id' => 1,
                    'fecha' => new DateTime(),
                    'total' => 150.00,
                    'estado' => 0,
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
};