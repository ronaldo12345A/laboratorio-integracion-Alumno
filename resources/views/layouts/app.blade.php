<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Académico')</title>
    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f3f4f6; /* Gris claro moderno */
            color: #1f2937; /* Gris oscuro para lectura cómoda */
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            max-width: 1000px;
            width: 100%;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.03);
        }

        h1 {
            margin-top: 0;
            color: #111827;
            font-size: 1.75rem;
            font-weight: 700;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }

        /* Mensajes de Alerta Estilizados */
        .alert-success {
            background-color: #ecfdf5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #ef4444;
            color: #991b1b;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        /* Formularios Profesionales */
        label {
            display: block;
            margin-top: 16px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background-color: #f9fafb;
        }

        input:focus {
            outline: none;
            border-color: #4f46e5; /* Azul Índigo */
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        /* Botones e Interacciones */
        button, .button {
            display: inline-block;
            margin-top: 24px;
            padding: 12px 24px;
            background-color: #4f46e5; /* Azul Índigo */
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
            text-align: center;
        }

        button:hover, .button:hover {
            background-color: #4338ca;
        }

        button:active, .button:active {
            transform: scale(0.98);
        }

        /* Tablas de Datos Limpias y Modernas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
            font-size: 0.95rem;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
        }

        tr:hover td {
            background-color: #f8fafc; /* Efecto hover en las filas */
        }

        .muted {
            color: #6b7280;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>