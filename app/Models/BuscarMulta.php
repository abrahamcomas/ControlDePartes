<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuscarMulta extends Model
{
    use HasFactory; 

    //referencia a una tabla
    protected $table="BuscarMulta";
    protected $primaryKey="Id_Buscador";
    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "Multa",
        "Token1",
        "Token2"
    ];

    public $timestamps = false;
}
