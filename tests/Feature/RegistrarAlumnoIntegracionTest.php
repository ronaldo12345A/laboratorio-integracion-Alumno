<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
class RegistrarAlumnoIntegracionTest extends TestCase 
{
    use RefreshDatabase;
    /*PRUEBA SIN ASILAMIENTO DEL SERVICIO EXTERNO
    public function test_registra_un_alumno_con_base_de_datos_real_de_pruebas(): void
    {
        $payload = [
        'codigo' => 'A001',
        'nombre' => 'Lucía Ramos',
        'email' => 'lucia@instituto.edu',
        ];

        $response = $this->postJson('/api/alumnos', $payload);

        $response->assertCreated()
            ->assertJson([
                'message' => 'Alumno registrado correctamente',
                'sincronizado' => false,
            ]);
        $this->assertDatabaseHas('alumnos', [
            'codigo' => 'A001',
            'nombre' => 'Lucía Ramos',
            'email' => 'lucia@instituto.edu',
            'estado' => 'activo',
        ]);
    } */


    /*PRUEBA CON ASILAMIENTO DEL SERVICIO EXTERNO*/
    public function test_registra_y_sincroniza_un_alumno_aislando_el_servicio_externo(): void
    {
        Http::fake([
            'padron.test/*' => Http::response([
                'message' => 'Alumno sincronizado'
            ], 200),
        ]);
        $payload = [
            'codigo' => 'A002',
            'nombre' => 'Carlos Medina',
            'email' => 'carlos@instituto.edu',
        ];
        $response = $this->postJson('/api/alumnos', $payload);
        
        $response->assertCreated()
            ->assertJson([
                'message' => 'Alumno registrado correctamente',
                'sincronizado' => true,
            ]);
        $this->assertDatabaseHas('alumnos', [
            'codigo' => 'A002',
            'nombre' => 'Carlos Medina',
            'email' => 'carlos@instituto.edu',
            'estado' => 'activo',
        ]);
    }

 }