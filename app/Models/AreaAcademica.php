<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaAcademica extends Model
{
    use HasFactory;

    protected $table = 'areas_academicas';
    protected $primaryKey = 'id_area_academica';

    protected $fillable = ['nombre_area'];

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'id_area_academica');
    }

    public function profesores()
    {
        return $this->hasMany(Profesor::class, 'id_area_academica');
    }
}
