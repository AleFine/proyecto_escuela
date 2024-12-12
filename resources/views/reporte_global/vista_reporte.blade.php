@extends('layout.layout')

@section('contenido')
<div class="container mt-5">
    <h1 class="text-center mb-4">Reporte Global por Grado</h1>
    <h3 class="text-center">Grado: {{ $grado->nombre_grado }}</h3>
    <p class="text-center text-muted">Nivel: {{ $nivel->nombre_nivel }} | Sección: {{ $seccion->nombre_seccion }}</p>

    <!-- Métricas principales -->
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Promedio General</h5>
                    <p class="card-text display-5">{{ number_format($promedioGeneral, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Estudiantes con Mejor Rendimiento</h5>
                    <p class="card-text display-5">{{ $mejorRendimiento }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Estudiantes con Riesgo Académico</h5>
                    <p class="card-text display-5">{{ $riesgoAcademico }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="text-center">Promedio de Calificaciones por Curso</h5>
                    <canvas id="calificacionesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('calificacionesChart').getContext('2d');
        const calificacionesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($cursos) !!}, // Array de nombres de cursos
                datasets: [{
                    label: 'Promedio de Calificaciones',
                    data: {!! json_encode($promediosPorCurso) !!}, // Array de promedios por curso
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
