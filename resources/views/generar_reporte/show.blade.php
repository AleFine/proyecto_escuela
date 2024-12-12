@extends('layout.layout')

@section('contenido')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Rendimiento del Estudiante</h1>
        </div>
        <div class="card-body mt-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4><strong>Estudiante:</strong> {{ $alumno->nombre }} {{ $alumno->apellido }}</h4>
                    <h4><strong>Grado:</strong> {{ $grado->nombre_grado }}</h4>
                </div>
                <div class="col-md-6">
                    <h4><strong>Sección:</strong> {{ $seccion->nombre_seccion }}</h4>
                    <h4><strong>Curso:</strong> {{ $curso->nombre_curso }}</h4>
                </div>
            </div>

            <div class="chart-container" style="position: relative; height:50vh; width:100%">
                <canvas id="notasChart"></canvas>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('reporte.index_admin') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Volver a Cursos
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataForChart = @json($dataForChart);

    const ctx = document.getElementById('notasChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: dataForChart.labels.map(label => label.replace('unidad', 'Unidad ')),
            datasets: dataForChart.datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 20,
                    title: {
                        display: true,
                        text: 'Calificación'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Unidades'
                    }
                }
            }
        }
    });
</script>
@endsection
