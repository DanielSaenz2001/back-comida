<?php

namespace App\Models\Logistica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    public $timestamps = false;

    protected $table = 'cajas';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
