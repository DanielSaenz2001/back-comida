<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $miTiempo = Carbon::now();

        Schema::create('links', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('nombre', 2230);
            $table->string('link', 2230);
            $table->string('icon', 50);
            $table->boolean('visible');
            $table->integer('orden');
            $table->unsignedInteger('padre_id')->nullable();

            $table->foreign('padre_id')->references('id')->on('links');

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('links')->insert(
            [
                // Seguridad
                [ //1
                    'nombre'    => 'Seguridad',
                    'link'      => '/seguridad',
                    'icon'      => 'settings-2-outline',
                    'visible'   => true,
                    'orden'     => '10',
                    'padre_id'  => null,
                ],
                [ //2
                    'nombre'    => 'Administración de Usuarios',
                    'link'      => '/usuarios',
                    'icon'      => 'people-outline',
                    'visible'   => true,
                    'orden'     => '1',
                    'padre_id'  => 1,
                ],
                [ //3
                    'nombre'    => 'Administración de Rutas',
                    'link'      => '/links',
                    'icon'      => 'link-2-outline',
                    'visible'   => true,
                    'orden'     => '2',
                    'padre_id'  => 1,
                ],
                [ //4
                    'nombre'    => 'Administración de Permisos',
                    'link'      => '/permisos',
                    'icon'      => 'shield-outline',
                    'visible'   => true,
                    'orden'     => '3',
                    'padre_id'  => 1,
                ],
                // Logistica
                [ //5
                    'nombre'    => 'Logistica',
                    'link'      => '/logistica',
                    'icon'      => 'settings',
                    'visible'   => true,
                    'orden'     => '2',
                    'padre_id'  => null,
                ],
                [ //6
                    'nombre'    => 'Establecimiento',
                    'link'      => '/establecimiento',
                    'icon'      => 'people-outline',
                    'visible'   => true,
                    'orden'     => '1',
                    'padre_id'  => 5,
                ],
                [ //7
                    'nombre'    => 'Sucursal',
                    'link'      => '/sucursal',
                    'icon'      => 'link-2-outline',
                    'visible'   => true,
                    'orden'     => '2',
                    'padre_id'  => 5,
                ],
                [ //8
                    'nombre'    => 'Caja',
                    'link'      => '/caja',
                    'icon'      => 'shield-outline',
                    'visible'   => true,
                    'orden'     => '3',
                    'padre_id'  => 5,
                ],
                [ //9
                    'nombre'    => 'Almacen',
                    'link'      => '/almacen',
                    'icon'      => 'shield-outline',
                    'visible'   => true,
                    'orden'     => '4',
                    'padre_id'  => 5,
                ],
                [ //10
                    'nombre'    => 'Empleado',
                    'link'      => '/empleado',
                    'icon'      => 'shield-outline',
                    'visible'   => true,
                    'orden'     => '5',
                    'padre_id'  => 5,
                ],
                [ //11
                    'nombre'    => 'Tipo de Pago',
                    'link'      => '/tipo-pago',
                    'icon'      => 'shield-outline',
                    'visible'   => true,
                    'orden'     => '6',
                    'padre_id'  => 5,
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
        Schema::dropIfExists('links');
    }
};
