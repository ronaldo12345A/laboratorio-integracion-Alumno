<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Services\PadronExternoService;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function store(Request $request, PadronExternoService $padronService)
    {
        // Validar los datos
        $validated = $request->validate([
            'codigo' => 'required|unique:alumnos',
            'nombre' => 'required|string',
            'email' => 'required|email|unique:alumnos',
        ]);

        // Crear el alumno
        $alumno = Alumno::create([
            'codigo' => $validated['codigo'],
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'estado' => 'activo',
        ]);

        // Intentar sincronizar con el servicio externo
        $sincronizado = $padronService->sincronizar($alumno);

        // Responder con éxito
        return response()->json([
            'message' => 'Alumno registrado correctamente',
            'sincronizado' => $sincronizado,
            'alumno' => $alumno
        ], 201);
    }
}