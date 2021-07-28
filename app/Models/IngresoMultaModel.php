<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoMultaModel extends Model
{
    use HasFactory; 

    //referencia a una tabla
    protected $table="Multas";
    protected $primaryKey="Id_Multas";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "Firma",
        "Estado", 
        "Parte",
        "NumeroParte",
        "Anio",
    	"Id_Ciudadanos",
    	"Id_Inspector",
    	"Id_Juzgado",
        "id_TipoInfraccion", 
        "Id_Vehiculo", 
        "Lugar",
        "Hora",
        "InfraccionArticulo",
        "DecLey",
        "DetallesDecLey",
        "Testigo",
        "Fecha",
    ]; 
}
