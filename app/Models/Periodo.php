<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $table = 'periodos';
    protected $primaryKey = 'id_periodo';

    protected $fillable = ['nombre_periodo', 'fecha_inicio', 'fecha_fin'];

    public function unidades()
    {
        return $this->hasMany(Unidad::class, 'id_periodo');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_periodo');
    }
}
