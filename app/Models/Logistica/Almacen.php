<?php

namespace App\Models\Logistica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    public $timestamps = false;

    protected $table = 'almacenes';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
