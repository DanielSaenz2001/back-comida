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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('empresa', 100);
            $table->string('ruc', 11);
            $table->string('representante', 100);
            $table->string('email', 255);
            $table->string('telefono', 9);
            $table->boolean('estado')->default(false);

            $table->unique('ruc');

            $table->charset   = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('proveedores')->insert(
            [
                [
                    'empresa' => "TESTO EMPRESA",
                    'ruc' => "59168740295",
                    'representante' => 1,
                    'email' => 1,
                    'telefono' => true,
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
        Schema::dropIfExists('proveedores');
    }
};