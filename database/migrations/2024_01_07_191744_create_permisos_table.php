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
        Schema::create('permisos', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->boolean('activo');

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('permisos')->insert(
            [
                [//1
                    'nombre' => 'Administración de Usuarios',
                    'codigo' => 'SUsuarios',
                    'activo' => true
                ],
                 [//2
                    'nombre' => 'Administración de Rutas',
                    'codigo' => 'SRutas',
                    'activo' => true
                ],
                [//3
                    'nombre' => 'Administración de Permisos',
                    'codigo' => 'SPermisos',
                    'activo' => true
                ],
                [//4
                    'nombre' => 'Administración de Establecimientos',
                    'codigo' => 'LEstablcimiento',
                    'activo' => true
                ],
                [//5
                    'nombre' => 'Administración de Sucurcales',
                    'codigo' => 'LSucursal',
                    'activo' => true
                ],
                [//6
                    'nombre' => 'Administración de Tipo de Pagos',
                    'codigo' => 'LTPago',
                    'activo' => true
                ],
                [//7
                    'nombre' => 'Administración de Cajas',
                    'codigo' => 'LCaja',
                    'activo' => true
                ],
                [//8
                    'nombre' => 'Administración de Almacenes',
                    'codigo' => 'LAlmacen',
                    'activo' => true
                ],
                [//9
                    'nombre' => 'Administración de Empleados',
                    'codigo' => 'LEmpleado',
                    'activo' => true
                ],
                [//10
                    'nombre' => 'Mozo',
                    'codigo' => 'Mozo',
                    'activo' => true
                ],
                [//11
                    'nombre' => 'Almacenero',
                    'codigo' => 'Almacenero',
                    'activo' => true
                ],
                [//12
                    'nombre' => 'Cajero',
                    'codigo' => 'Cajero',
                    'activo' => true
                ],
                [//13
                    'nombre' => 'Administración de Proveedores',
                    'codigo' => 'LProveedor',
                    'activo' => true
                ],
                [//14
                    'nombre' => 'Gestion de Productos',
                    'codigo' => 'AProductos',
                    'activo' => true
                ],
                [//15
                    'nombre' => 'Gestion de Productos de Almacen',
                    'codigo' => 'AAlmacen',
                    'activo' => true
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
        Schema::dropIfExists('permisos');
    }
};
