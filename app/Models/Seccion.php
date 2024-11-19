<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;

    protected $table = 'secciones';
    protected $primaryKey = 'id_seccion';

    protected $fillable = ['nombre_seccion', 'aforo', 'id_grado'];

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_seccion');
    }
}
