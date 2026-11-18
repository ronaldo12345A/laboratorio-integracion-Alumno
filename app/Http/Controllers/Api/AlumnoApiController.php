<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlumnoApiController extends Controller
{
    public function index(): JsonResponse
    {
        $alumnos = Alumno::orderBy('id')->get();

        return response()->json([
            'data' => $alumnos,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate(
            [
                'codigo' => ['required', 'string', 'max:20', 'unique:alumnos,codigo'],
                'nombre' => ['required', 'string', 'max:120'],
                'email' => ['required', 'email', 'unique:alumnos,email'],
            ],
            [
                'codigo.required' => 'Debe ingresar el código del alumno.',
                'nombre.required' => 'Debe ingresar el nombre del alumno.',
                'email.required' => 'Debe ingresar el correo del alumno.',
                'email.email' => 'Debe ingresar un correo válido.',
                'email.unique' => 'El correo ya está registrado.',
            ]
        );

        $alumno = Alumno::create([
            'codigo' => $validated['codigo'],
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'estado' => 'activo',
        ]);

        return response()->json([
            'message' => 'Alumno registrado correctamente',
            'data' => $alumno,
        ], 201);
    }
}