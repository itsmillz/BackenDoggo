<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class interacciones extends Model
{
    use HasFactory;
    protected $table ="interacciones";
    protected $primaryKey ='id';
    public $timestamps = true;

    protected $filliable = [
        "perro_interesado",
        "perro_candidato",
        "preferencia"
    ];

    public function perro_interesado(){
        return $this->belongsTo(perro::class,"perro_interesado");
    }
    public function perro_candidato(){
        return $this->belongsTo(perro::class,"perro_candidato");
    }
}
