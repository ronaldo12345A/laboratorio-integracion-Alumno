<?php

use App\Http\Controllers\Api\AlumnoApiController;
use Illuminate\Support\Facades\Route;
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
// RUTAS DE LA GUÍA 11 (PASO 2)
// ==========================================

// Login SIN límite de intentos (vulnerable)
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }
    return ['token' => $user->createToken('app')->plainTextToken];
});

Route::middleware('auth:sanctum')->group(function () {
    // Correcta: solo los pedidos del usuario autenticado
    Route::get('/pedidos', fn (Request $r) => $r->user()->pedidos);
    // VULNERABLE: no verifica quién es el dueño (IDOR)
    Route::get('/pedidos/{id}', fn ($id) => Pedido::findOrFail($id));
    // VULNERABLE: guarda sin validar los datos
    Route::post('/pedidos', fn (Request $r) =>
        $r->user()->pedidos()->create($r->only('descripcion', 'total')));
});