<?php

namespace App\Http\Livewire\Reportes;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class ReporteJuzgado extends Component
{	
	use WithPagination;
  public $FechaDE; 
  public $FechaHasta;
  public $perPage = '5';
  public $M_Detalles;
  public $Id_Multas;
  public $Datos;
  public $Testigo; 
  public $Detalles='0';

  protected $queryString = [
        'FechaDE'=>['except'=>''],
        'FechaHasta'=>['except'=>''],
        'perPage'
      ];


  public function M_Detalles($Id_Multas)
    {
        $this->Id_Multas=$Id_Multas;
        $this->Detalles='1';
    }

  public function O_Detalles()
    {
        $this->Detalles='0'; 
    } 

  public function clear()
    {
        $this->search='';
        $this->perPage='5';
        $this->FechaDE=''; 
        $this->FechaHasta='';
    }

  protected $paginationTheme = 'bootstrap';
  public function render()
    {
        $ID_Juzgado_T=Auth::guard('Funcionario')->user()->ID_Juzgado_T;

    	  $this->Datos =  DB::table('Multas') 
            ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
            ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
            ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
            ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
            ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
            ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
            ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
            ->select('Id_Multas','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','NombreArt','Hora','Nombres','Inspectores.Apellidos AS ApellidosInsp','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Ciudadanos.Rut AS RutCiudadano','Profesion','NombreNac','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar')
            ->where('Multas.Id_Juzgado', '=', $ID_Juzgado_T)
            ->where('Multas.Firma', '=', "1")
            ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();

        $Imagenes =  DB::table('Imagenes')
            ->leftjoin('Multas', 'Imagenes.Id_Multa_Tabla', '=', 'Multas.Id_Multas')
            ->where('Id_Multa_Tabla', '=', $this->Id_Multas)->get();
        
            $this->Testigo =  DB::table('Multas') 
            ->leftjoin('Testigos', 'Multas.Id_Multas', '=', 'Testigos.id_Multas_T')
            ->leftjoin('Inspectores', 'Testigos.Id_Inspectores', '=', 'Inspectores.id_inspector')
            ->select('Nombres','Apellidos')
            ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();
        return view('livewire.reportes.reporte-juzgado',[

			  'posts' =>  DB::table('Multas')
          ->leftjoin('Document', 'Multas.Id_Multas', '=', 'Document.id_Multa_T')
          ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
          ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
          ->select('Ruta','Id_Multas','NumeroParte','Anio','Id_Juzgado','PlacaPatente','Marca','Modelo','Fecha','Nombres','Apellidos','Fecha')
          ->where('Multas.Id_Juzgado', '=', $ID_Juzgado_T)
          ->where('Multas.Firma', '=', "1")
          ->whereBetween('Fecha', [$this->FechaDE, $this->FechaHasta])
          ->paginate($this->perPage),
        'Datos'=>$this->Datos,
        'Imagenes'=>$Imagenes,
        'Testigo'=>$this->Testigo
        ]);
    }
}  
 