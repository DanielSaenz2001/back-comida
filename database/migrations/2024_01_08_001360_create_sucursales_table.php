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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('establecimiento_id');

            $table->string('direccion', 255);
            $table->string('representante', 255);
            $table->string('administrador', 255);
            $table->string('coordinador', 255);
            $table->string('telefono', 9);

            $table->foreign('establecimiento_id')->references('id')->on('establecimientos');
            
            $table->charset   = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('sucursales')->insert(
            [
                [
                    'direccion' => "Comida Regional",
                    'representante' => "Comida Regional",
                    'administrador' => "Comida Regional",
                    'coordinador' => "Comida Regional",
                    'telefono' => "925625818",
                    'establecimiento_id' => 1,
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
        Schema::dropIfExists('sucursales');
    }
};