<?php

namespace App\Models\Logistica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    public $timestamps = false;

    protected $table = 'establecimientos';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
}
