<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grado extends Model
{
    use HasFactory;

    protected $table = 'grados';
    protected $primaryKey = 'id_grado';

    protected $fillable = ['nombre_grado', 'id_nivel'];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'id_nivel');
    }

    public function secciones()
    {
        return $this->hasMany(Seccion::class, 'id_grado');
    }

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'id_grado');
    }
}
