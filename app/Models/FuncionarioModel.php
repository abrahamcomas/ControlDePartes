<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioModel extends Model
{
    use HasFactory;

     //referencia a una tabla
    protected $table="Funcionario";
    protected $primaryKey="id_Funcionario";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[ 
        "Activo",
        "Rut",
        "Nombres",
        "Apellidos",
        "Email",
        "password",
        "CorreoActivo"
    ];
}  