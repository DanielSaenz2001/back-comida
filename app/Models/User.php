<?php

namespace App\Models;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject{
    public $timestamps = false;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];

    protected $fillable = [
        'nombres', 
        'ap_paterno',
        'ap_materno',
        'fec_nacimiento',
        'dni',
        'email',
        'celular',
        'estado',
        'username'
    ];

    protected $hidden = [
        'password'
    ];
    
    protected $casts = [
        'estado'    => 'boolean'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function scopeNombre($query, $name){
        return $query->where('users.nombres','like',"%$name%");
    }

    public function scopePaterno($query, $paterno){
        return $query->where('users.ap_paterno','like',"%$paterno%");
    }

    public function scopeMaterno($query, $materno){
        return $query->where('users.ap_materno','like',"%$materno%");
    }

    public function scopeDni($query, $dni){
        return $query->where('users.dni','like',"%$dni%");
    }

    public function scopeUser($query, $username){
        return $query->where('users.username','like',"%$username%");
    }

    public function scopeEmail($query, $email){
        return $query->where('users.email','like',"%$email%");
    }

    public function scopeEstado($query, $estado){
        return $query->where('users.estado','like',"$estado");
    }
}
