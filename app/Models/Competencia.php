<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competencia extends Model
{
    use HasFactory;

    protected $table = 'competencias';
    protected $primaryKey = 'id_competencia';
    protected $fillable = ['nombre_competencia'];

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'id_competencia');
    }
}
