<?php

namespace App\Models\Logistica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public $timestamps = false;

    protected $table = 'empleados';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
