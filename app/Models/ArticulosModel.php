<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticulosModel extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Articulo";
    protected $primaryKey="id_Articulo";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "NombreArt"
    ];
}
