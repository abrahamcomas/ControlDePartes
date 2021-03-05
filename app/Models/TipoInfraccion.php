<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInfraccion extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="TipoInfraccion";
    protected $primaryKey="id_Infraccion";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "descripcion"
    ];
}
