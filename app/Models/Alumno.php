<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    protected $primaryKey = 'id_alumno';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'genero',
        'region',
        'ciudad',
        'distrito',
        'telefono',
        'imagen_rostro',
    ];

    public function padres()
    {
        return $this->belongsToMany(PadreFamilia::class, 'relacion_padres_alumnos', 'id_alumno', 'id_padre_familia');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_alumno');
    }
}
