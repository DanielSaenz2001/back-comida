<?php

namespace App\Models\Logistica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    public $timestamps = false;

    protected $table = 'tipos_pago';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
