<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'profesores';
    protected $primaryKey = 'id_profesor';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_ingreso',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'id_area_academica',
        'user_id'
    ];

    public function areaAcademica()
    {
        return $this->belongsTo(AreaAcademica::class, 'id_area_academica');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'profesor_cursos', 'id_profesor', 'id_curso');
    }

    public function docente_asignado(){
        return $this->hasMany(DocenteAsignado::class, 'id_profesor');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function nivel(){
        return $this->belongsTo(Nivel::class, 'id_nivel');
    }

}
