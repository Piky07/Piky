<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_trabajo_id',
        'descripcion',
        'cantidad',
        'unidad_medida',
        'precio_unitario',
        'precio_total',
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'precio_unitario' => 'decimal:2',
        'precio_total' => 'decimal:2',
    ];

    // Relaciones
    public function orden()
    {
        return $this->belongsTo(OrdenTrabajo::class, 'orden_trabajo_id');
    }

    // Métodos
    public function calcularTotal()
    {
        $this->precio_total = $this->cantidad * $this->precio_unitario;
        return $this->precio_total;
    }
}
