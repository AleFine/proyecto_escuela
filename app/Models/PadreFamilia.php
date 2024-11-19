<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PadreFamilia extends Model
{
    use HasFactory;

    protected $table = 'padres_familia';

    protected $primaryKey = 'id_padre_familia';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'telefono',
    ];

    public function hijos()
    {
        return $this->belongsToMany(Alumno::class, 'relacion_padres_alumnos', 'id_padre_familia', 'id_alumno');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id','id');
    }
}
