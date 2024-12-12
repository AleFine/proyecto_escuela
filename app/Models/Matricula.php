<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';
    protected $primaryKey = 'id_matricula';

    protected $fillable = ['id_alumno', 'id_periodo', 'id_seccion', 'estado'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo');
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'id_seccion');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'id_matricula');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'matricula_cursos', 'id_matricula', 'id_curso');
    }

}
