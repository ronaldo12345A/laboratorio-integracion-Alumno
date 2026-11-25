<?php

use App\Http\Controllers\Api\AlumnoApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Route::get('/alumnos', [AlumnoApiController::class, 'index']);
Route::post('/alumnos', [AlumnoApiController::class, 'store']);

Route::get('/alumnos', function () {
    return response()->json([
        ['id' => 1, 'nombre' => 'Ronaldo Casilla Mamani', 'codigo' => '74829103', 'carrera' => 'Ingeniería de Sistemas'],
        ['id' => 2, 'nombre' => 'Juan Aldair', 'codigo' => '74829104', 'carrera' => 'Ingeniería de Sistemas'],
        ['id' => 3, 'nombre' => 'Maria Fernanda Quispe', 'codigo' => '74829105', 'carrera' => 'Ingeniería de Sistemas'],
    ]);
});

Route::get('/ping', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API disponible'
    ]);
});

// ==========================================
// RUTAS DE LA GUÍA 12 - CONTRAMEDIDAS (PASOS 2 Y 3)
// ==========================================

// Login CON límite de 5 intentos por minuto y registro detectivo en laravel.log
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        Log::warning('Login fallido', ['email' => $request->email, 'ip' => $request->ip()]);
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }
    return ['token' => $user->createToken('app')->plainTextToken];
})->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {
    // Listar solo los pedidos del usuario autenticado
    Route::get('/pedidos', fn (Request $r) => $r->user()->pedidos);

    // Control de acceso: solo busca entre los pedidos del usuario autenticado (cierra IDOR)
    Route::get('/pedidos/{id}', fn (Request $r, $id) =>
        $r->user()->pedidos()->findOrFail($id));

    // Validación: rechaza datos incompletos o fuera de rango (cierra error 500)
    Route::post('/pedidos', function (Request $r) {
        $datos = $r->validate([
            'descripcion' => 'required|string|max:255',
            'total'       => 'required|numeric|min:0',
        ]);
        return $r->user()->pedidos()->create($datos);
    });

    // Revocar el token actual en el servidor al cerrar sesión
    Route::post('/logout', function (Request $r) {
        $r->user()->currentAccessToken()->delete();
        return response()->noContent();
    });
});