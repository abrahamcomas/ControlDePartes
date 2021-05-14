<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Imagenes";
    protected $primaryKey="ID_Imagen ";
    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "Id_Multa_Tabla",
        "RutaImagen"
    ];

    public $timestamps = false;
}
