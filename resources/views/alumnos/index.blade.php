@extends('layouts.app')

@section('title', 'Listado de alumnos')

@section('content')
    <h1>Listado de alumnos</h1>
    <p class="muted">
        Esta pantalla es una interfaz Blade que consumirá datos desde la API mediante JavaScript.
    </p>

    <a class="button" href="{{ route('alumnos.create') }}">Nuevo alumno</a>

    <div id="notificacion"></div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody id="tabla-alumnos">
            </tbody>
    </table>

    <script>
        // Lógica para mostrar la notificación flash desde sessionStorage
        const notificacion = document.getElementById('notificacion');
        const flashSuccess = sessionStorage.getItem('flash_success');

        if (flashSuccess) {
            const div = document.createElement('div');
            div.className = 'alert-success';
            div.textContent = flashSuccess;
            notificacion.appendChild(div);
            
            // Borramos el mensaje para que no vuelva a aparecer al recargar
            sessionStorage.removeItem('flash_success');
        }

        // Lógica para consumir la API y listar los alumnos en la tabla
        async function cargarAlumnos() {
            const response = await fetch('/api/alumnos');
            const data = await response.json();

            const tbody = document.getElementById('tabla-alumnos');
            tbody.innerHTML = '';

            data.data.forEach(alumno => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${alumno.id}</td>
                    <td>${alumno.codigo}</td>
                    <td>${alumno.nombre}</td>
                    <td>${alumno.email}</td>
                    <td>${alumno.estado}</td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Ejecutar la función al cargar la página
        cargarAlumnos();
    </script>
@endsection