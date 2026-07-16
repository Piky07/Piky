<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_trabajo_id',
        'firma_tecnico',
        'firma_operador',
        'fecha_firma_tecnico',
        'fecha_firma_operador',
    ];

    protected $casts = [
        'fecha_firma_tecnico' => 'datetime',
        'fecha_firma_operador' => 'datetime',
    ];

    // Relaciones
    public function orden()
    {
        return $this->belongsTo(OrdenTrabajo::class, 'orden_trabajo_id');
    }
}
