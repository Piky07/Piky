<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'contacto',
        'telefono',
        'email',
        'direccion',
    ];

    // Relaciones
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    public function ordenes()
    {
        return $this->hasMany(OrdenTrabajo::class);
    }
}
