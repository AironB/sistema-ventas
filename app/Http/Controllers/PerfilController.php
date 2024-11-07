<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    //
    public function index()
    {
        $idUsuario = Auth::user()->id_usuario;
        $datos = DB::select("select * from usuario where id_usuario=$idUsuario");
        return view("vistas.perfil", compact("datos"));
    }
}
