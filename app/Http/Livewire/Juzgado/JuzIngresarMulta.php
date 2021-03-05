<?php

namespace App\Http\Livewire\Juzgado;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB; 
use App\Models\IngresoMultaModel;  

class JuzIngresarMulta extends Component
{
	use WithPagination;
  public $M_Detalles;
  public $Id_Multas;
  public $Testigo;
  public $Datos; 
    
  public function M_Detalles($Id_Multas)
    {
        $this->Id_Multas=$Id_Multas;
      
    }

  public function IngresarMulta($Id_MultasIngreso)
    {
    	$Hora = date('H:i:s');
      $Fecha = date("Y/m/d");

    	$Multa = IngresoMultaModel::find( $Id_MultasIngreso);

		  $Multa->EstadoMulta      = '1';
		  $Multa->IngresoJuzFecha  = $Fecha;
		  $Multa->HoraIngJuz       = $Hora;
		  $Multa->save();
    } 

  protected $paginationTheme = 'bootstrap';
  public function render()
    { 

    
      $this->Datos =  DB::table('Multas') 
        ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
        ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
        ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
        ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
        ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
        ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
        ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
        ->select('Id_Multas','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','NombreArt','Hora','Nombres','Inspectores.Apellidos AS ApellidosInsp','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Ciudadanos.Rut AS RutCiudadano','Profesion','NombreNac','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar')
        ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();

      $this->Testigo =  DB::table('Multas') 
        ->leftjoin('Testigos', 'Multas.Id_Multas', '=', 'Testigos.id_Multas_T')
        ->leftjoin('Inspectores', 'Testigos.Id_Inspectores', '=', 'Inspectores.id_inspector')
        ->select('Nombres','Apellidos')
        ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();

      return view('livewire.juzgado.juz-ingresar-multa',[
        'posts' =>  DB::table('Multas')
          ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
          ->select('Id_Multas','PlacaPatente','Marca','Modelo','Fecha')
          ->where('EstadoMulta', '=', '0')
          ->paginate(10),
        'Datos'=>$this->Datos,
        'Testigo'=>$this->Testigo  
      ]);
    }
}
