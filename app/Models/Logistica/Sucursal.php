<?php

namespace App\Models\Logistica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public $timestamps = false;

    protected $table = 'sucursales';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
