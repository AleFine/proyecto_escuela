<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $table = 'distritos';

    protected $fillable = ['nombre', 'ciudad_id'];

    /**
     * Relación uno a muchos inversa con la tabla ciudades.
     * Un distrito pertenece a una ciudad.
     */
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}
