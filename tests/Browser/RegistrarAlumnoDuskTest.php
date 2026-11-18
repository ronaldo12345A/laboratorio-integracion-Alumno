<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrarAlumnoDuskTest extends DuskTestCase
{
   

   public function test_usuario_registra_un_alumno_desde_una_interfaz_que_consume_la_api(): void
    {
        // Creamos la variable aleatoria para que no se dupliquen los datos en la base de datos
        $idAleatorio = rand(1000, 9999);

        $this->browse(function (Browser $browser) use ($idAleatorio) {
            $browser->visit('/alumnos/crear')
                ->type('@codigo', 'A01'.$idAleatorio)
                ->type('@nombre', 'Lucia Ramos')
                ->type('@email', 'lucia' . $idAleatorio . '@instituto.edu')
                ->press('@btn-guardar')
                ->waitForText('Alumno registrado correctamente')
                ->assertPathIs('/alumnos')
                ->assertSee('Lucia Ramos')
                ->assertSee('lucia' . $idAleatorio . '@instituto.edu')
                ->assertSee('activo');
        });
    }

    public function test_muestra_errores_de_validacion_cuando_faltan_datos(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/alumnos/crear')
                ->press('@btn-guardar')
                ->waitForText('Debe ingresar el código del alumno.')
                ->assertPathIs('/alumnos/crear')
                ->assertSee('Debe ingresar el código del alumno.')
                ->assertSee('Debe ingresar el nombre del alumno.')
                ->assertSee('Debe ingresar el correo del alumno.');
        });
    }
}