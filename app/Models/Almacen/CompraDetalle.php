<?php

namespace App\Models\Almacen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    public $timestamps = false;

    protected $table = 'compra_detalle';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
