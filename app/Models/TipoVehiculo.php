<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="TipoVehiculo";
    protected $primaryKey="id";
    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "id_Codigo",
        "Descripcion_TV"
    ];

    public $timestamps = false;
}
