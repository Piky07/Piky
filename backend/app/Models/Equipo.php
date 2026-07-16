<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'codigo',
        'descripcion',
        'marca',
        'modelo',
        'chasis',
        'numero_motor',
        'vin',
        'placa',
        'color',
        'ano',
        'propietario',
        'empresa_id',
        'estado',
    ];

    protected $casts = [
        'ano' => 'integer',
    ];

    // Estados
    const ESTADO_DISPONIBLE = 'disponible';
    const ESTADO_EN_REPARACION = 'en_reparacion';
    const ESTADO_INACTIVO = 'inactivo';

    // Relaciones
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function ordenes()
    {
        return $this->hasMany(OrdenTrabajo::class);
    }
}
