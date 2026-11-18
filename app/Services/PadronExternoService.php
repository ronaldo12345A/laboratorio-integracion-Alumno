<?php

namespace App\Services;

use App\Models\Alumno;
use Illuminate\Support\Facades\Http;

class PadronExternoService
{
    public function sincronizar(Alumno $alumno): bool
    {
        $response = Http::post('https://padron.test/api/alumnos', [
            'codigo' => $alumno->codigo,
            'nombre' => $alumno->nombre,
            'email' => $alumno->email,
        ]);
        
        return $response->successful();
    }
}