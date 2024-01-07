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
        Schema::create('producto_almacen', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('producto_id');
            $table->unsignedInteger('almacen_id');
            $table->integer('stock')->default(0);

            $table->foreign('almacen_id')->references('id')->on('almacenes');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unique(['almacen_id', 'producto_id']);

            $table->charset   = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('producto_almacen')->insert(
            [
                [
                    'producto_id' => 1,
                    'almacen_id' => 1,
                    'stock' => 0
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
        Schema::dropIfExists('producto_almacen');
    }
};