<?php

namespace App\Http\Livewire\MultaVehicular;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Facades\Auth;

class ListaMultasIngresadas extends Component
{	  
    use WithPagination;
    public $search = '';
    public $perPage = '5';
    public $AnioSelect;
    public $M_Detalles;
    public $Id_Multas;
    public $Datos;
    public $Testigo;
    public $Detalles='0';

    protected $queryString = ['search' =>['except'=>''],
    'perPage','AnioSelect'
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
        $this->AnioSelect=date('y');
    }


    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
      
      $this->id_inspector  =  Auth::user()->id_inspector;

      if ($this->AnioSelect=='') {
        $this->AnioSelect=date('y');
      }

    	$this->Datos =  DB::table('Multas') 
            ->leftjoin('Document', 'Multas.Id_Multas', '=', 'Document.id_Multa_T')
            ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
            ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
            ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
            ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
            ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
            ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
            ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
            ->select('Ruta','Id_Multas','Parte','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','NombreArt','Hora','Nombres','Inspectores.Apellidos AS ApellidosInsp','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Profesion','NombreNac','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar','Ciudadanos.Rut AS RutCiudadano')
            ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();
 
        $this->Imagenes =  DB::table('Imagenes')
                            ->leftjoin('Multas', 'Imagenes.Id_Multa_Tabla', '=', 'Multas.Id_Multas')
                            ->where('Id_Multa_Tabla', '=', $this->Id_Multas)->get();

    	$this->Testigo =  DB::table('Multas') 
            ->leftjoin('Testigos', 'Multas.Id_Multas', '=', 'Testigos.id_Multas_T')
            ->leftjoin('Inspectores', 'Testigos.Id_Inspectores', '=', 'Inspectores.id_inspector')
            ->select('Nombres','Apellidos')
            ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();

        return view('livewire.multa-vehicular.lista-multas-ingresadas',[

			    'posts' =>  DB::table('Multas')
            ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
          	->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
          	->select('Id_Multas','Parte','PlacaPatente')
            ->where('Estado', '=', '1')
            ->where('Firma', '=', '1') 
            ->where('Anio', '=', $this->AnioSelect)
            ->where(function($query) {
                $query->orwhere('Parte', 'like', "%{$this->search}%")
                      ->orwhere('PlacaPatente', 'like', "%{$this->search}%");
            })     
            ->where('Inspectores.id_inspector', '=', $this->id_inspector)        
          	->paginate($this->perPage),
          'Anio' =>  DB::table('Multas')
            ->select('Anio') 
            ->distinct('Anio')        
            ->get(), 
        	'Datos'=>$this->Datos,
            'Imagenes'=>$this->Imagenes,
        	'Testigo'=>$this->Testigo 
        ]);
    }
}
