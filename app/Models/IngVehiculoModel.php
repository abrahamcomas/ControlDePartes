<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngVehiculoModel extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Vehiculos";
    protected $primaryKey="id_Vehiculo";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "id_Vehiculo",
    	"PlacaPatente",
    	"TipoVehiculo",
    	"Marca",
        "Modelo", 
        "Color"
    ]; 

    public $timestamps = false;
}
