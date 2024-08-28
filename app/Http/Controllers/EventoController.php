<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Invitado;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('dashboard', ['eventos' => $eventos]);
    }

    public function lector()
    {
        $invitados = Invitado::all();
        return view('lector', ['invitados' => $invitados]);
    }

    public function registroIngreso($id)
    {
        // Encuentra el invitado por ID o maneja el caso en que no exista
        $invitado = Invitado::find($id);

        if (!$invitado) {
            return redirect()->route('lector')->with('error', 'Invitado no encontrado');
        }

        // Actualiza el registro
        $invitado->update([
            'ingreso' => 1
        ]);

        // Redirige a la vista 'lector' con un mensaje de éxito
        return redirect()->route('lector')->with('mensaje', 'Ingreso registrado');
    }
}
