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
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('empresa', 255);
            $table->string('ubicacion', 255);
            $table->string('numero_contacto', 9);
            $table->tinyInteger('tipo');
            $table->string('representante', 255);
            
            $table->charset   = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('establecimientos')->insert(
            [
                [
                    'empresa' => "Comida Regional",
                    'ubicacion' => "Comida Regional",
                    'numero_contacto' => "925625818",
                    'tipo' => 0,
                    'representante' => "Comida Regional",
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
        Schema::dropIfExists('establecimientos');
    }
};
