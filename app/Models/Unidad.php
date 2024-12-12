<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades';
    protected $primaryKey = 'id_unidad';

    protected $fillable = ['nombre_unidad', 'id_periodo', 'orden'];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'id_unidad');
    }
}
