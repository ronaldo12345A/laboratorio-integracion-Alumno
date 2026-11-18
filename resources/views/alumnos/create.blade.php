@extends('layouts.app')

@section('title', 'Registrar alumno')

@section('content')
    <h1>Registrar alumno</h1>
    <p class="muted">
        Esta pantalla es una interfaz Blade que enviará datos a la API mediante JavaScript.
    </p>

    <a class="button" href="{{ route('alumnos.index') }}">Ver lista</a>

    <div id="errores"></div>

    <form dusk="form-registro" id="form-registro">
        <label for="codigo">Código</label>
        <input dusk="codigo" id="codigo" name="codigo" type="text">

        <label for="nombre">Nombre</label>
        <input dusk="nombre" id="nombre" name="nombre" type="text">

        <label for="email">Correo</label>
        <input dusk="email" id="email" name="email" type="email">

        <button dusk="btn-guardar" type="submit">Registrar alumno</button>
    </form>

    <script>
        const form = document.getElementById('form-registro');
        const errores = document.getElementById('errores');

        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            errores.innerHTML = '';

            const payload = {
                codigo: document.getElementById('codigo').value,
                nombre: document.getElementById('nombre').value,
                email: document.getElementById('email').value,
            };

            const response = await fetch('/api/alumnos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            const data = await response.json();

            if (response.ok) {
                sessionStorage.setItem('flash_success', data.message);
                window.location.href = '/alumnos';
                return;
            }

            if (data.errors) {
                Object.values(data.errors).forEach(messages => {
                    messages.forEach(message => {
                        const div = document.createElement('div');
                        div.className = 'alert-error';
                        div.textContent = message;
                        errores.appendChild(div);
                    });
                });
            }
        });
    </script>
@endsection