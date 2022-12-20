<?php

namespace App\Http\Controllers;
use App\Http\Requests\InteraccionRequest;
use App\Http\Requests\MostrarInteraccionesRequest;
use App\Models\interacciones;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InteraccionController extends Controller
{
    public function mostrarInteracciones(MostrarInteraccionesRequest $request){

        $interacciones = interacciones::where('perro_interesado',$request-> perro_interesado)->get();
        if($interacciones->count()==0){
            return response()->json([
                "Mensaje" => "No hay interacciones registradas"
            ],response::HTTP_NOT_FOUND);
        }

        return response()->json([
            "mensaje"=> "Se han encontrado registros",
            "data" => $interacciones
        ],response::HTTP_OK);

    }
    public function store(InteraccionRequest $request){
        $filas = interacciones::where('perro_interesado',$request->perro_interesado)
        -> where("perro_candidato",$request->perro_candidato) -> get();
        if($filas->count() !=0){
            return response()->json([
                "mensaje"=> "Se encontraros registros existentes "
             ],Response::HTTP_NOT_FOUND);
        }else{
            if($request -> perro_interesado != $request -> perro_candidato){
                $interaccion = new interacciones();
                $interaccion->perro_interesado = $request -> perro_interesado;
                $interaccion->perro_candidato = $request -> perro_candidato;
                $interaccion->preferencia = $request->preferencia;
                $resultado = $interaccion->save();
                if($resultado){
                    return response()->json([
                        "mensaje"=>"se ha registrado la interacción",
                        "interaccion"=>$interaccion
                    ],Response::HTTP_OK);
                }
                    return response()->json([
                        "mensaje" => "Error al crear la interacción"
                    ],Response::HTTP_NOT_FOUND);

            }
            return response()->json([
                "mensaje"=> "El id del perro interesado debe ser distinto al candidato"
            ],Response::HTTP_BAD_REQUEST);
        }
    }

}
