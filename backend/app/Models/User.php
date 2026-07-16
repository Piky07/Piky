<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JwtAuth\Contracts\JwtSubject;

class User extends Authenticatable implements JwtSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'empresa_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Roles disponibles
    const ROLE_ADMIN = 'admin';
    const ROLE_TECNICO = 'tecnico';
    const ROLE_OPERADOR = 'operador';
    const ROLE_VISUALIZADOR = 'visualizador';

    // Relaciones
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function ordenesComoTecnico()
    {
        return $this->hasMany(OrdenTrabajo::class, 'tecnico_id');
    }

    public function ordenesComoOperador()
    {
        return $this->hasMany(OrdenTrabajo::class, 'operador_id');
    }

    // JWT
    public function getJwtIdentifier()
    {
        return $this->getKey();
    }

    public function getJwtCustomClaims()
    {
        return [];
    }

    // Métodos de autorización
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isTecnico()
    {
        return $this->role === self::ROLE_TECNICO;
    }

    public function isOperador()
    {
        return $this->role === self::ROLE_OPERADOR;
    }
}
