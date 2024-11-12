<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    protected $fillable = ['nombre', 'region_id'];

    /**
     * Relación uno a muchos inversa con la tabla regiones.
     * Una ciudad pertenece a una región.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Relación uno a muchos con la tabla distritos.
     * Una ciudad tiene muchos distritos.
     */
    public function distritos()
    {
        return $this->hasMany(Distrito::class);
    }
}
