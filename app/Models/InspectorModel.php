<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectorModel extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Inspectores";
    protected $primaryKey="id_inspector";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"Activo",
        "TipoFirma",
    	"Rut",
    	"Nombres",
        "Apellidos", 
        "Email", 
        "password",
        "CorreoActivo"
    ]; 
}
