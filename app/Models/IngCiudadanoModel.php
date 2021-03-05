<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngCiudadanoModel extends Model
{
    use HasFactory;

       //referencia a una tabla
    protected $table="Ciudadanos";
    protected $primaryKey="id_Ciudadano";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"Rut",
    	"NombresC",
        "Apellidos",  
        "Profesion", 
        "ID_Nacionalidad",
        "FechaNacimiento",
        "Domicilio"
    ]; 

    public function Nacionalidad()
    {
        return $this->hasOne(Nacionalidad::class,'id_Nacionalidad','ID_Nacionalidad');
    }
}
