<?php

namespace Tests\Feature;

use App\Models\Tarea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    // Le dice a Laravel que corra las migraciones en memoria antes de hacer los tests, 
    // solucionando el error "no such table: tareas"
    use RefreshDatabase;

    public function test_la_ruta_raiz_redirige_a_tareas(): void
    {
        $response = $this->get('/');

        // Verifica que hace un redireccionamiento (302) a la ruta correcta
        $response->assertStatus(302);
        $response->assertRedirect(route('tareas.index'));
    }

    public function test_el_panel_de_tareas_carga_correctamente(): void
    {
        // Se crea una tarea falsa usando el Factory para ver si aparece en pantalla
        $tarea = Tarea::factory()->create([
            'titulo' => 'Mi Tarea Súper Secreta'
        ]);

        $response = $this->get(route('tareas.index'));

        // Verifica que la página cargó bien (200 OK)
        $response->assertStatus(200);
        
        // Verifica que se ve el título de la página y la tarea que se acaba de crear
        $response->assertSee('Mis Tareas');
        $response->assertSee('Mi Tarea Súper Secreta');
    }

    public function test_la_pantalla_de_creacion_carga_correctamente(): void
    {
        $response = $this->get(route('tareas.create'));
        
        $response->assertStatus(200);
        $response->assertSee('Crear Nueva Tarea');
    }

    public function test_se_puede_guardar_una_tarea_nueva(): void
    {
        // Se simulan los datos que enviaría un usuario en el formulario
        $datos = [
            'titulo' => 'Aprender Laravel Testing',
            'descripcion' => 'Tengo que pasar la prueba técnica',
            'prioridad' => 'alta',
            'completada' => 0, // 0 = false en formulario
        ];

        // Se hace la petición POST simulando enviar el formulario
        $response = $this->post(route('tareas.store'), $datos);

        // Se verifica que se haya guardado en la Base de Datos
        $this->assertDatabaseHas('tareas', [
            'titulo' => 'Aprender Laravel Testing',
            'prioridad' => 'alta'
        ]);
        
        // Se verifica que nos redirija al index con el mensaje de éxito exacto
        $response->assertRedirect(route('tareas.index'));
        $response->assertSessionHas('success', 'Tarea creada correctamente.');
    }

    public function test_la_pantalla_de_edicion_carga_con_los_datos(): void
    {
        $tarea = Tarea::factory()->create();

        $response = $this->get(route('tareas.edit', $tarea->id));
        
        $response->assertStatus(200);
        $response->assertSee($tarea->titulo); // El título viejo debe estar en la pantalla
    }

    public function test_se_puede_actualizar_una_tarea_existente(): void
    {
        // 1. Creamos la tarea
        $tarea = Tarea::factory()->create([
            'titulo' => 'Título Viejo'
        ]);

        // 2. Se preparan los datos nuevos
        $datosNuevos = [
            'titulo' => 'Título Actualizado',
            'descripcion' => $tarea->descripcion,
            'prioridad' => 'media',
            'completada' => $tarea->completada,
        ];

        // 3. Se envía el PUT
        $response = $this->put(route('tareas.update', $tarea->id), $datosNuevos);

        // 4. Se verifica que el título cambió en la BD
        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id, 
            'titulo' => 'Título Actualizado'
        ]);
        
        $response->assertRedirect(route('tareas.index'));
        $response->assertSessionHas('success', 'Tarea actualizada correctamente.');
    }

    public function test_se_puede_eliminar_una_tarea(): void
    {
        $tarea = Tarea::factory()->create();

        $response = $this->delete(route('tareas.destroy', $tarea->id));

        // Se verifica que ya no exista en la BD
        $this->assertDatabaseMissing('tareas', [
            'id' => $tarea->id
        ]);
        
        $response->assertRedirect(route('tareas.index'));
        $response->assertSessionHas('success', 'Tarea eliminada.');
    }

    public function test_se_puede_alternar_el_estado_de_la_tarea(): void
    {
        // Se crea la tarea como incompleta
        $tarea = Tarea::factory()->create([
            'completada' => false
        ]);

        // Se hace PATCH a la ruta toggle
        $response = $this->patch(route('tareas.toggle', $tarea->id));

        // Se le pide a Laravel que traiga la tarea fresca de la BD
        $tarea->refresh();

        // Ahora debe ser true
        $this->assertTrue($tarea->completada);
        $response->assertRedirect(route('tareas.index'));
    }
}
