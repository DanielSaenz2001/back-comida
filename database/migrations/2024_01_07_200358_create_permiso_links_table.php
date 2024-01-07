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
                [
                    'link_id' => 6,
                    'permiso_id' => 4,
                ],
                [
                    'link_id' => 7,
                    'permiso_id' => 5,
                ],
                [
                    'link_id' => 8,
                    'permiso_id' => 6,
                ],
                [
                    'link_id' => 9,
                    'permiso_id' => 7,
                ],
                [
                    'link_id' => 10,
                    'permiso_id' => 8,
                ],
                [
                    'link_id' => 11,
                    'permiso_id' => 9,
                ],
                [
                    'link_id' => 12,
                    'permiso_id' => 13,
                ],
                [
                    'link_id' => 16,
                    'permiso_id' => 11,
                ],
                [
                    'link_id' => 14,
                    'permiso_id' => 14,
                ],
                [
                    'link_id' => 15,
                    'permiso_id' => 15,
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
