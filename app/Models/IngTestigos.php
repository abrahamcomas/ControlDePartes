<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngTestigos extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Testigos";
    protected $primaryKey="id_Testigos";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "id_Multas",
    	"id_Inspectores"
    ]; 
}
