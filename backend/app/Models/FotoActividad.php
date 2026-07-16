<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoActividad extends Model
{
    use HasFactory;

    protected $table = 'fotos_actividades';

    protected $fillable = [
        'actividad_id',
        'ruta_archivo',
        'nombre_original',
    ];

    // Relaciones
    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }
}
