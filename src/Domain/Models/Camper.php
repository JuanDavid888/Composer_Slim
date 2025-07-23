<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Camper extends Model
{
    protected $table = 'campers'; // Nombre tabla
    protected $primaryKey = 'id'; // Llave primaria
    public $timestamps = true; // Habilita el uso de created_at y updated_at
    protected $fillable = ['nombre', 'edad', 'documento', 'tipo_documento', 'nivel_ingles', 'nivel_programacion']; // Columnas habilitadas para la insercion

}