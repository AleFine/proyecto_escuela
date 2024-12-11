<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculaCurso extends Model
{
    use HasFactory;

    protected $table = 'matricula_cursos';

    protected $primaryKey = ['id_curso', 'id_matricula'];

    public $incrementing = false; // No se incrementa automáticamente

    protected $fillable = [
        'id_curso',
        'id_matricula',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'id_matricula');
    }
}
