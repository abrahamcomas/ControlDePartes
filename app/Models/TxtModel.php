<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TxtModel extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Document";
    protected $primaryKey="id";
    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "id_Multa_T",
        "Ruta"
    ];


}
