<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerroRequest;
use App\Models\perro;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PerroController extends Controller
{
    public function guardar_perro(PerroRequest $request){
        $perro = new perro();
        $perro->nombre = $request->nombre;
        $perro->url_foto = $request->url_foto;
        $perro->descripcion = $request->descripcion;
        $registro = $perro->save();
        if($registro){
            return response()->json("Perro registrado",Response::HTTP_OK);
        }else{
            return response()->json("Error al registrar un perro",Response::HTTP_NOT_FOUND);
        }
    }
    public function actualizar_perro(Request $request){
        try{
            $request->validate([
                "id"=>"required|integer",
            ]);
            $perro = perro::findorFail($request->id);
            isset($request->nombre) && $perro->nombre = $request->nombre;
            isset($request->url_imagen) && $perro->url_imagen = $request->url_imagen;
            isset($request->descripcion) && $perro->descripcion = $request->descripcion;
            $perro->save();
            return response()->json([
                "mensaje"=>"Perro",
                "data" => $perro
            ]);
        }catch(Exception $e){
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function eliminar_perro(Request $request){
        try {
            $request->validate([
                "id"=>"required|integer|exists:perros,id"
            ]);
             perro::find($request->id)->delete();
            return response()->json(["Perro eliminado"], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}
