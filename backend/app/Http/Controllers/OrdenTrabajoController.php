<?php

namespace App\Http\Controllers;

use App\Models\OrdenTrabajo;
use App\Models\Actividad;
use App\Models\Insumo;
use Illuminate\Http\Request;

class OrdenTrabajoController extends Controller
{
    public function index()
    {
        $ordenes = OrdenTrabajo::where('empresa_id', auth()->user()->empresa_id)
            ->with(['equipo', 'tecnico', 'operador'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return response()->json($ordenes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_orden' => 'required|string|unique:ordenes_trabajo',
            'equipo_id' => 'required|exists:equipos,id',
            'tecnico_id' => 'nullable|exists:users,id',
            'operador_id' => 'nullable|exists:users,id',
            'ubicacion_proyecto' => 'required|string',
            'horometro' => 'nullable|numeric',
            'km' => 'nullable|numeric',
            'observaciones' => 'nullable|string',
        ]);

        $orden = OrdenTrabajo::create([
            ...$validated,
            'empresa_id' => auth()->user()->empresa_id,
            'fecha_apertura' => now(),
            'estado' => 'abierta',
        ]);

        return response()->json([
            'message' => 'Orden de trabajo creada exitosamente',
            'orden' => $orden->load(['equipo', 'tecnico', 'operador']),
        ], 201);
    }

    public function show($id)
    {
        $orden = OrdenTrabajo::where('empresa_id', auth()->user()->empresa_id)
            ->with(['equipo', 'tecnico', 'operador', 'actividades.fotos', 'insumos', 'firma'])
            ->find($id);

        if (!$orden) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }

        return response()->json($orden);
    }

    public function update(Request $request, $id)
    {
        $orden = OrdenTrabajo::where('empresa_id', auth()->user()->empresa_id)
            ->find($id);

        if (!$orden) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }

        $validated = $request->validate([
            'numero_orden' => 'sometimes|string|unique:ordenes_trabajo,numero_orden,' . $id,
            'equipo_id' => 'sometimes|exists:equipos,id',
            'tecnico_id' => 'nullable|exists:users,id',
            'operador_id' => 'nullable|exists:users,id',
            'ubicacion_proyecto' => 'sometimes|string',
            'horometro' => 'nullable|numeric',
            'km' => 'nullable|numeric',
            'estado' => 'sometimes|in:abierta,en_proceso,cerrada,entregada',
            'observaciones' => 'nullable|string',
        ]);

        $orden->update($validated);

        return response()->json([
            'message' => 'Orden actualizada exitosamente',
            'orden' => $orden->load(['equipo', 'tecnico', 'operador']),
        ]);
    }

    public function destroy($id)
    {
        $orden = OrdenTrabajo::where('empresa_id', auth()->user()->empresa_id)
            ->find($id);

        if (!$orden) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }

        $orden->delete();

        return response()->json(['message' => 'Orden eliminada exitosamente']);
    }

    public function cerrarOrden($id)
    {
        $orden = OrdenTrabajo::where('empresa_id', auth()->user()->empresa_id)
            ->find($id);

        if (!$orden) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }

        // Calcular costo total
        $subtotal = $orden->insumos->sum('precio_total');
        $costo_total = $subtotal;

        $orden->update([
            'estado' => 'cerrada',
            'fecha_cierre' => now(),
            'subtotal' => $subtotal,
            'costo_total' => $costo_total,
        ]);

        return response()->json([
            'message' => 'Orden cerrada exitosamente',
            'orden' => $orden,
        ]);
    }

    public function entregarOrden($id)
    {
        $orden = OrdenTrabajo::where('empresa_id', auth()->user()->empresa_id)
            ->find($id);

        if (!$orden) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }

        if ($orden->estado !== 'cerrada') {
            return response()->json(['error' => 'La orden debe estar cerrada antes de entregarla'], 400);
        }

        $orden->update(['estado' => 'entregada']);

        return response()->json([
            'message' => 'Orden entregada exitosamente',
            'orden' => $orden,
        ]);
    }

    public function getByNumero($numero)
    {
        $orden = OrdenTrabajo::where('empresa_id', auth()->user()->empresa_id)
            ->where('numero_orden', $numero)
            ->with(['equipo', 'tecnico', 'operador', 'actividades.fotos', 'insumos'])
            ->first();

        if (!$orden) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }

        return response()->json($orden);
    }

    public function getOrdenesPorEstado($estado)
    {
        $ordenes = OrdenTrabajo::where('empresa_id', auth()->user()->empresa_id)
            ->where('estado', $estado)
            ->with(['equipo', 'tecnico', 'operador'])
            ->paginate(15);

        return response()->json($ordenes);
    }
}
