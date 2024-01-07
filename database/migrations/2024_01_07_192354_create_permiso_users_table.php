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
        Schema::create('permiso_users', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('permiso_id');
            $table->unsignedInteger('user_id');

            $table->foreign('permiso_id')->references('id')->on('permisos');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unique(['user_id', 'permiso_id']);
            
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('permiso_users')->insert(
            [
                [
                    'user_id' => 1,
                    'permiso_id' => 1,
                ],
                [
                    'user_id' => 1,
                    'permiso_id' => 2,
                ],
                [
                    'user_id' => 1,
                    'permiso_id' => 3,
                ],
                [
                    'user_id' => 1,
                    'permiso_id' => 4,
                ],
                [
                    'user_id' => 1,
                    'permiso_id' => 5,
                ],
                [
                    'user_id' => 1,
                    'permiso_id' => 6,
                ],
                [
                    'user_id' => 1,
                    'permiso_id' => 7,
                ],
                [
                    'user_id' => 1,
                    'permiso_id' => 8,
                ],
                [
                    'user_id' => 1,
                    'permiso_id' => 9,
                ],
                [
                    'user_id' => 2,
                    'permiso_id' => 10,
                ],
                [
                    'user_id' => 1,
                    'permiso_id' => 13,
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
        Schema::dropIfExists('permiso_users');
    }
};