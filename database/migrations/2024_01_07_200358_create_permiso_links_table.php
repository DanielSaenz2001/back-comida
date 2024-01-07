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
        Schema::create('permiso_links', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('link_id');
            $table->unsignedInteger('permiso_id');

            $table->foreign('permiso_id')->references('id')->on('permisos');
            $table->foreign('link_id')->references('id')->on('links');

            $table->unique(['link_id', 'permiso_id']);
            
            $table->charset   = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('permiso_links')->insert(
            [
                [
                    'link_id' => 2,
                    'permiso_id' => 1,
                ],
                [
                    'link_id' => 3,
                    'permiso_id' => 2,
                ],
                [
                    'link_id' => 4,
                    'permiso_id' => 3,
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
        Schema::dropIfExists('permiso_links');
    }
};
