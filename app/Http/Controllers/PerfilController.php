<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;

class PerfilController extends Controller
{
    //
    public function index()
    {
        $idUsuario = Auth::user()->id_usuario;
        $datos = DB::select("select * from usuario where id_usuario=$idUsuario");
        return view("vistas.perfil", compact("datos"));
    }
    public function actualizarIMG(Request $request)
    {
        $request->validate([
            "foto" => "required|image|mimes:jpg,png,jpeg"
        ]);
        $file = $request->file("foto");
        $idUsuario = Auth::user()->id_usuario;
        $nombreArchivo = $idUsuario . "." . strtolower($file->getClientOriginalExtension());
        $ruta = storage_path("app/public/FOTOS-PERFIL-USUARIO/" . $nombreArchivo);
       
        //verificacion de la foto para eliminar si actualmente posee una
        $verificarfoto = DB::select ("select foto from usuario where id_usuario=$idUsuario ");
        $verificarfoto = $verificarfoto[0]->foto;

        if ($verificarfoto != null){
            $rutaFotoAnterior = storage_path("app/public/FOTOS-PERFIL-USUARIO/$verificarfoto");
            try{
            unlink($rutaFotoAnterior);
            } catch(\Throwable $th) {}
        }
        //aca modificamos la ruta donde se guardaran las imagenes
        $res = move_uploaded_file($file, $ruta);

        try {

            $actualizarFoto = DB::update("update usuario set foto='$nombreArchivo' where id_usuario=$idUsuario");
            if ($actualizarFoto == 0) {
                $actualizarFoto = 1;
            }
        } catch (\Throwable $th) {
            $actualizarFoto = 0;
        }
        if ($res and $actualizarFoto) {
            return back()->with("mensaje", "Imagen actualizada correctamente");
        } else {
            return back()->with("error", "Error al actualizar la imagen");
        }
    }
}
