<?php

namespace App\Models\Logistica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagoSucursal extends Model
{
    public $timestamps = false;

    protected $table = 'tipos_pago_surcursales';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
