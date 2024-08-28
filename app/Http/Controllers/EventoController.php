<?php

namespace App\Http\Controllers;
use App\Models\Evento; 

use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index(){
        $eventos = Evento::all();
        return view('dashboard', ['eventos' => $eventos]);
    }

    public function lector(){
        return view('lector');
    }
}
