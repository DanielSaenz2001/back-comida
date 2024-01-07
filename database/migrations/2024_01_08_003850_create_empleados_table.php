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
        Schema::create('empleados', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('sucursal_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('caja_id')->nullable();
            $table->unsignedInteger('almacen_id')->nullable();
            $table->tinyInteger('isCaja');
            $table->tinyInteger('isAlmacen');
            $table->tinyInteger('isMoso');
            $table->tinyInteger('estado');

            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->foreign('almacen_id')->references('id')->on('almacenes');

            $table->unique('user_id');

            $table->charset   = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('empleados')->insert(
            [
                [
                    'sucursal_id' => 1,
                    'user_id' => 2,
                    'caja_id' => 1,
                    'almacen_id' => 1,
                    'isCaja' => true,
                    'isAlmacen' => true,
                    'isMoso' => true,
                    'estado' => true,
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
        Schema::dropIfExists('empleados');
    }
};