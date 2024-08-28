<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    use HasFactory;

    // La tabla asociada al modelo.
    protected $table = 'invitados';

    // Los atributos que se pueden asignar masivamente.
    protected $fillable = [
        'identificacion',
        'nombre',
        'email',
        'tipo',
        'invitacion',
        'id_evento',
        'ingreso',  // Agrega el campo ingreso aquí
    ];

    // Los atributos que deberían ser ocultados para arrays.
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Los atributos que deberían ser mutados a tipos de datos nativos.
    protected $casts = [
        'invitacion' => 'boolean',
    ];

    /**
     * Relación con el modelo Evento.
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }
}
