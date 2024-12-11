<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocenteAsignado extends Model
{
    use HasFactory;

    protected $table = 'docente_asignado';
    protected $primaryKey = 'id_docente_asignado';
    protected $fillable = ['id_profesor', 'id_seccion'];

    public function profesor(){
        return $this->belongsTo(Profesor::class, 'id_profesor');
    }

    public function seccion(){
        return $this->belongsTo(Seccion::class, 'id_seccion');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'profesor_cursos', 'id_docente_asignado', 'id_curso');
    }

    public function periodo(){
        return $this->belongsTo(Periodo::class, 'id_periodo');
    }

}
