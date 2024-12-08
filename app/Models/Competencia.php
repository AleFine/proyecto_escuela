<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competencia extends Model
{
    use HasFactory;

    protected $table = 'competencias';
    protected $primaryKey = 'id_competencia';

    protected $fillable = ['nombre_competencia', 'descripcion', 'id_unidad', 'id_curso'];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'id_unidad');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    public function calificaciones()
    {
        return $this->hasOne(Calificacion::class, 'id_competencia');
    }
}
