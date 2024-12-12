<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2, h3, h4 {
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background: #f2f2f2;
        }
        .info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Reporte de Notas</h2>
    <div class="info">
        <p><strong>Alumno:</strong> {{ $alumno->nombre }} {{ $alumno->apellido }}</p>
        <p><strong>Período:</strong> {{ $matricula->periodo->nombre_periodo }}</p>
        <p><strong>Sección:</strong> {{ $matricula->seccion->nombre_seccion }}</p>
    </div>

    @php

        function letraANumero($letra) {
            switch ($letra) {
                case 'AD': return 20;
                case 'A': return 16;
                case 'B': return 13;
                case 'C': return 10;
                default: return 0; 
            }
        }

        function numeroALetra($numero) {
            if ($numero >= 18) {
                return 'AD';
            } elseif ($numero >= 14) {
                return 'A';
            } elseif ($numero >= 11) {
                return 'B';
            } elseif ($numero >= 6) {
                return 'C';
            } else {
                return 'D';
            }
        }
    @endphp

    @foreach($dataCursos as $curso)
        <h3>Curso: {{ $curso['nombre_curso'] }}</h3>
        <table>
            <thead>
                <tr>
                    <th>Competencia / Unidad</th>
                    <th>Unidad 1</th>
                    <th>Unidad 2</th>
                    <th>Unidad 3</th>
                    <th>Promedio Final</th>
                </tr>
            </thead>
            <tbody>
                @foreach($curso['competencias'] as $comp)
                    @php
                        $u1Num = letraANumero($comp['u1']);
                        $u2Num = letraANumero($comp['u2']);
                        $u3Num = letraANumero($comp['u3']);

                        $promedioNum = ($u1Num + $u2Num + $u3Num) / 3;

                        $promedioLetra = numeroALetra($promedioNum);
                    @endphp
                    <tr>
                        <th>{{ $comp['nombre'] }}</th>
                        <td>{{ $comp['u1'] }}</td>
                        <td>{{ $comp['u2'] }}</td>
                        <td>{{ $comp['u3'] }}</td>
                        <td>{{ $promedioLetra }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <p>Reporte generado el {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
</body>
</html>
