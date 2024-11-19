<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'niveles';
    protected $primaryKey = 'id_nivel';
 
    protected $fillable = ['nombre_nivel', 'turno'];

    public function grados()
    {
        return $this->hasMany(Grado::class, 'id_nivel');
    }
}
