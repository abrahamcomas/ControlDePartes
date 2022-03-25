<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumeroInfracciones extends Model
{
    use HasFactory;

      //referencia a una tabla
      protected $table="NumeroInfracciones";
      protected $primaryKey="Id_Infracciones";
  
      //pongo los caampos para permitir insert multiple
      protected $fillable=[
          "Id_Direccion_T",
          "NumeroParte",
          "Anio"
      ];

      public $timestamps = false;
}
