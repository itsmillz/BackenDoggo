<?php

use App\Http\Controllers\InteraccionController;
use App\Http\Controllers\PerroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(PerroController::class)->group(function(){
    Route::post("/perro","guardar_perro");
    Route::put("/perro","actualizar_perro");
    Route::delete("/perro","eliminar_perro");
});

Route::controller(InteraccionController::class) -> group(function(){
    Route::get("/interacciones","mostrarInteracciones");
    Route::post("/interaccion","store");
});
