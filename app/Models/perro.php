<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perro extends Model
{
    use HasFactory;
    protected $table = "perros";
    protected $primaryKey='id';
    public $timestamps="true";

    protected $filliable =[
        "nombre",
        "url_foto",
        "descripcion"
    ];
}
