<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $miTiempo = Carbon::now();
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('nombres', 100);
            $table->string('ap_paterno', 100);
            $table->string('ap_materno', 100);
            $table->date('fec_nacimiento');
            $table->tinyInteger('sexo');
            $table->string('dni', 8)->unique();
            $table->string('email', 50)->unique();
            $table->string('celular', 9)->unique();
            $table->boolean('estado')->default(false);
            $table->string('direccion', 510)->nullable();
            $table->string('username', 50)->unique();
            $table->string('password');

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('users')->insert(
            [
                [
                    'nombres' => 'Comida',
                    'ap_paterno' => 'Super',
                    'ap_materno' => 'Admin',
                    'fec_nacimiento' => $miTiempo,
                    'sexo' => 0,
                    'dni' => '00000001',
                    'email' => 'comida@gmail.com',
                    'celular' => '000000001',
                    'estado' => true,
                    'username' => 'comida',
                    'password' => '$2y$10$JV4U.EfcQgNPGPPmRjmnu.D7q0wWRoFlK.4DIFpxfnnubza.hF7Hm',
                ],
                [
                    'nombres' => 'Comida2',
                    'ap_paterno' => 'Super',
                    'ap_materno' => 'test',
                    'fec_nacimiento' => $miTiempo,
                    'sexo' => 0,
                    'dni' => '00000002',
                    'email' => 'comida2@gmail.com',
                    'celular' => '000000002',
                    'estado' => true,
                    'username' => 'comida2',
                    'password' => '$2y$10$JV4U.EfcQgNPGPPmRjmnu.D7q0wWRoFlK.4DIFpxfnnubza.hF7Hm',
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
        Schema::dropIfExists('users');
    }
}
