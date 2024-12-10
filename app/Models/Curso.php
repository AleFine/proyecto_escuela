<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';
    protected $primaryKey = 'id_curso';

    protected $fillable = ['nombre_curso', 'id_area_academica', 'id_grado'];

    public function areaAcademica()
    {
        return $this->belongsTo(AreaAcademica::class, 'id_area_academica');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado');
    }

    public function competencias()
    {
        return $this->hasMany(Competencia::class, 'id_curso');
    }

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'profesor_cursos', 'id_curso', 'id_docente_asignado');
    }

    public function matricula()
    {
        return $this->belongsToMany(Matricula::class, 'matricula_cursos', 'id_curso', 'id_matricula');
    }
}
