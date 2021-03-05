<?php
 
namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Nacionalidad";
    protected $primaryKey="id_Nacionalidad";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"NombreNac"
    ]; 
}
