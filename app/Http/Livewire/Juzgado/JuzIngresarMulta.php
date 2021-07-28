<?php

namespace App\Http\Livewire\Juzgado;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB; 
use App\Models\IngresoMultaModel;  
use Illuminate\Support\Facades\Auth;

class JuzIngresarMulta extends Component
{
	use WithPagination;
  public $M_Detalles;
  public $Id_Multas;
  public $Testigo;
  public $Datos; 
  public $Detalles='0'; 

  public $ConfirmarIngreso='0'; 
  public function VolverDetalles()
    {
      $this->Detalles='0';
    }
  public function ConfirmarIngreso()
    {
      $this->ConfirmarIngreso='1'; 
      $this->Detalles='0';
    }

  public function CancelarConfirmarIngreso()
    {
        $this->ConfirmarIngreso='0'; 
        $this->Detalles='0';
    }
  
  public function M_Detalles($Id_Multas)
    {
        $this->Id_Multas=$Id_Multas; 
        $this->Detalles='1';
    }

  public function IngresarMulta($Id_MultasIngreso)
    { 
    	$Hora = date('H:i:s');
      $Fecha = date("Y/m/d"); 

    	$Multa = IngresoMultaModel::find($Id_MultasIngreso);

		  $Multa->Estado      = '1';
		  $Multa->IngresoJuzFecha  = $Fecha;
		  $Multa->HoraIngJuz       = $Hora;
		  $Multa->save();

      $this->Detalles='0'; 
      $this->ConfirmarIngreso='0'; 
    } 

  protected $paginationTheme = 'bootstrap';
  public function render()
    {  

      $ID_Juzgado_T=Auth::guard('Funcionario')->user()->ID_Juzgado_T;
    
      $this->Datos =  DB::table('Multas') 
      ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector') 
      ->leftjoin('Document', 'Multas.Id_Multas', '=', 'Document.id_Multa_T')
      ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
      ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
      ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
      ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
      ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
      ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
      ->select('Id_Multas','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','NombreArt','Hora','InfraccionArticulo','DecLey','Nombres','Inspectores.Apellidos AS ApellidosInsp','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Ciudadanos.Rut AS RutCiudadano','Profesion','NombreNac','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar','Ruta','V_Descripcion')
      ->where('Multas.Id_Juzgado', '=', $ID_Juzgado_T)
      ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();
 
      $this->Imagenes =  DB::table('Imagenes')
        ->leftjoin('Multas', 'Imagenes.Id_Multa_Tabla', '=', 'Multas.Id_Multas')
        ->where('Id_Multa_Tabla', '=', $this->Id_Multas)->get();

      $this->Testigo =  DB::table('Multas') 
        ->leftjoin('Testigos', 'Multas.Id_Multas', '=', 'Testigos.id_Multas_T')
        ->leftjoin('Inspectores', 'Testigos.Id_Inspectores', '=', 'Inspectores.id_inspector')
        ->select('Nombres','Apellidos')
        ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();
 
      return view('livewire.juzgado.juz-ingresar-multa',[
        'posts' =>  DB::table('Multas') 
          ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
          ->select('Id_Multas','NumeroParte','Anio','Id_Juzgado','PlacaPatente','Marca','Modelo','Fecha')
          ->where('Firma', '=', '1')
          ->where('Estado', '=', '0')
          ->where('Id_Juzgado', '=', $ID_Juzgado_T)
          ->paginate(4),
        'Datos'=>$this->Datos,
        'Imagenes'=>$this->Imagenes,
        'Testigo'=>$this->Testigo  
      ]);
    }
}
