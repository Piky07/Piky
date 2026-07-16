<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_trabajo_id',
        'descripcion',
        'duracion_horas',
        'observaciones',
    ];

    protected $casts = [
        'duracion_horas' => 'decimal:2',
    ];

    // Relaciones
    public function orden()
    {
        return $this->belongsTo(OrdenTrabajo::class, 'orden_trabajo_id');
    }

    public function fotos()
    {
        return $this->hasMany(FotoActividad::class);
    }
}
