<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipos_pago_surcursales', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('sucursal_id');
            $table->unsignedInteger('tipo_pago_id');

            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->foreign('tipo_pago_id')->references('id')->on('tipos_pago');

            $table->unique(['tipo_pago_id', 'sucursal_id']);

            $table->charset   = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('tipos_pago_surcursales')->insert(
            [
                [
                    'sucursal_id' => 1,
                    'tipo_pago_id' => 1,
                ],
                [
                    'sucursal_id' => 1,
                    'tipo_pago_id' => 2,
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_pago_surcursales');
    }
};