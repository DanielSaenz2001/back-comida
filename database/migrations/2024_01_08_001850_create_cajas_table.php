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
        Schema::create('cajas', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('sucursal_id');

            $table->string('codigo', 5);
            $table->tinyInteger('estado');

            $table->foreign('sucursal_id')->references('id')->on('sucursales');

            $table->unique(['codigo', 'sucursal_id']);

            $table->charset   = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('cajas')->insert(
            [
                [
                    'codigo' => "002",
                    'estado' => true,
                    'sucursal_id' => 1,
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
        Schema::dropIfExists('cajas');
    }
};