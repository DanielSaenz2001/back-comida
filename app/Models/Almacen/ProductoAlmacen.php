<?php

namespace App\Models\Almacen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoAlmacen extends Model
{
    public $timestamps = false;

    protected $table = 'producto_almacen';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
