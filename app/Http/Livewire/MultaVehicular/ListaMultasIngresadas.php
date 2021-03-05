<?php

namespace App\Http\Livewire\MultaVehicular;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;  

class ListaMultasIngresadas extends Component
{	use WithPagination;
   	public $searchTerm;

      public $M_Detalles;
      public $Id_Multas;
      public $Datos;
      public $Testigo;
      public $Detalles='0';

  public function M_Detalles($Id_Multas)
    {
        $this->Id_Multas=$Id_Multas;
        $this->Detalles='1';
    }

     public function O_Detalles()
    {
        $this->Detalles='0';
    }

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
    	$query = '%'.$this->searchTerm.'%'; 
 

    	$this->Datos =  DB::table('Multas') 
            ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
            ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
            ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
            ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
            ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
            ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
            ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
            ->select('Id_Multas','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','NombreArt','Hora','Nombres','Inspectores.Apellidos AS ApellidosInsp','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Profesion','NombreNac','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar')
            ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();

    	$this->Testigo =  DB::table('Multas') 
            ->leftjoin('Testigos', 'Multas.Id_Multas', '=', 'Testigos.id_Multas_T')
            ->leftjoin('Inspectores', 'Testigos.Id_Inspectores', '=', 'Inspectores.id_inspector')
            ->select('Nombres','Apellidos')
            ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();

        return view('livewire.multa-vehicular.lista-multas-ingresadas',[

			'posts' =>  DB::table('Multas')
            ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
          	->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
          	->select('Id_Multas','PlacaPatente','Marca','Modelo','Fecha','Nombres','Apellidos')
          	->where('PlacaPatente', 'like', '%'.$this->searchTerm.'%')
          	->where('EstadoMulta', '=', '1')
          	->paginate(4),
        	'Datos'=>$this->Datos,
        	'Testigo'=>$this->Testigo 
        ]);
    }
}
