<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = 'ordenes_trabajo';

    protected $fillable = [
        'numero_orden',
        'equipo_id',
        'empresa_id',
        'tecnico_id',
        'operador_id',
        'fecha_apertura',
        'fecha_cierre',
        'ubicacion_proyecto',
        'horometro',
        'km',
        'estado',
        'costo_total',
        'subtotal',
        'observaciones',
    ];

    protected $casts = [
        'fecha_apertura' => 'datetime',
        'fecha_cierre' => 'datetime',
        'horometro' => 'decimal:2',
        'km' => 'decimal:2',
        'costo_total' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Estados
    const ESTADO_ABIERTA = 'abierta';
    const ESTADO_EN_PROCESO = 'en_proceso';
    const ESTADO_CERRADA = 'cerrada';
    const ESTADO_ENTREGADA = 'entregada';

    // Relaciones
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }

    public function operador()
    {
        return $this->belongsTo(User::class, 'operador_id');
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }

    public function insumos()
    {
        return $this->hasMany(Insumo::class);
    }

    public function firma()
    {
        return $this->hasOne(Firma::class);
    }

    // Métodos
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->numero_orden)) {
                $ultimaOrden = static::orderBy('id', 'desc')->first();
                $numero = $ultimaOrden ? intval(substr($ultimaOrden->numero_orden, 4)) + 1 : 1;
                $model->numero_orden = 'ORD-' . str_pad($numero, 6, '0', STR_PAD_LEFT);
            }
        });
    }

    public function calcularCostoTotal()
    {
        $this->subtotal = $this->insumos()->sum('precio_total');
        $this->costo_total = $this->subtotal;
        $this->save();
    }
}
