<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    // Los atributos que son asignables en masa.
    protected $fillable = ['nombre', 'descripcion', 'fecha'];

    // Los atributos que deberían ser tratados como fechas.
    protected $dates = ['fecha'];
}
