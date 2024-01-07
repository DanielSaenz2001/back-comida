<?php

namespace App\Models\Logistica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $timestamps = false;

    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
