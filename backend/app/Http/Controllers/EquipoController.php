<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::where('empresa_id', auth()->user()->empresa_id)
            ->paginate(15);
        return response()->json($equipos);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|unique:equipos',
            'descripcion' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'chasis' => 'nullable|string',
            'numero_motor' => 'nullable|string',
            'vin' => 'nullable|string',
            'placa' => 'nullable|string',
            'color' => 'nullable|string',
            'ano' => 'nullable|integer|min:1900|max:2099',
            'propietario' => 'required|string',
        ]);

        $equipo = Equipo::create([
            ...$validated,
            'empresa_id' => auth()->user()->empresa_id,
        ]);

        return response()->json([
            'message' => 'Equipo creado exitosamente',
            'equipo' => $equipo,
        ], 201);
    }

    public function show($id)
    {
        $equipo = Equipo::where('empresa_id', auth()->user()->empresa_id)
            ->find($id);

        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        return response()->json($equipo);
    }

    public function update(Request $request, $id)
    {
        $equipo = Equipo::where('empresa_id', auth()->user()->empresa_id)
            ->find($id);

        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        $validated = $request->validate([
            'codigo' => 'sometimes|string|unique:equipos,codigo,' . $id,
            'descripcion' => 'sometimes|string',
            'marca' => 'sometimes|string',
            'modelo' => 'sometimes|string',
            'chasis' => 'nullable|string',
            'numero_motor' => 'nullable|string',
            'vin' => 'nullable|string',
            'placa' => 'nullable|string',
            'color' => 'nullable|string',
            'ano' => 'nullable|integer|min:1900|max:2099',
            'propietario' => 'sometimes|string',
            'estado' => 'sometimes|in:disponible,en_reparacion,inactivo',
        ]);

        $equipo->update($validated);

        return response()->json([
            'message' => 'Equipo actualizado exitosamente',
            'equipo' => $equipo,
        ]);
    }

    public function destroy($id)
    {
        $equipo = Equipo::where('empresa_id', auth()->user()->empresa_id)
            ->find($id);

        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        $equipo->delete();

        return response()->json(['message' => 'Equipo eliminado exitosamente']);
    }

    public function getByCodigo($codigo)
    {
        $equipo = Equipo::where('empresa_id', auth()->user()->empresa_id)
            ->where('codigo', $codigo)
            ->first();

        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        return response()->json($equipo);
    }
}
