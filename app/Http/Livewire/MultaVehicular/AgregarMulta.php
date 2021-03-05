<?php

namespace App\Http\Livewire\MultaVehicular;

use Livewire\Component;
use Illuminate\Support\Facades\DB;  
use App\Models\IngresoMultaModel; 
use Illuminate\Http\Request;

class AgregarMulta extends Component
{

 	public $Rut; 
    public $Ciudadano; 
    public $NoIdentificado; 
    public $sqlPatentes; 
    public $Patente; 
    public $Marca;  
    public $TipoVehiculo; 
    public $Testigo; 

    public $Juzgado;
    public $Infraccion; 

    public $buscarM;
    public $Marcas;
    public $picked1;
    public $id_Marca;

    public $buscarTV;
    public $TipoVehiculos;
    public $pickedTV;
    public $id_InfraccionTV;


    public $buscar;
    public $Infracciones;
    public $picked;
    public $id_Infraccion;


    public $buscarArt;
    public $InfraccionesArt;
    public $pickedArt;
    public $id_Articulo;

    public $IdMultaingresar;

    public function mount()
    {
        $this->buscarM = "";
        $this->Marcas = [];
        $this->picked1 = true;

        $this->buscar = "";
        $this->Infracciones = [];
        $this->picked = true;

        $this->buscarTV = "";
        $this->InfraccionesTV = [];
        $this->pickedTV = true;

        $this->buscarArt = "";
        $this->InfraccionesArt = [];
        $this->pickedArt = true;
    } 

    public function updatedbuscarArt()
    {
        $this->pickedArt = false;


        $this->InfraccionesArt = DB::table('Articulo')->where("NombreArt", "like", trim($this->buscarArt) . "%")
            ->take(2)
            ->get();
        
    }

    public function asignarArticulo($nombre)
    {        
        $this->id_Articulo = DB::table('Articulo')->where("NombreArt", $nombre)->value("id_Articulo");
        
        $this->buscarArt = $nombre;          
        $this->pickedArt = true;
    }

    public function updatedBuscar()
    {
        $this->picked = false;


        $this->Infracciones = DB::table('TipoInfraccion')->where("descripcion", "like", trim($this->buscar) . "%")
            ->take(2)
            ->get();
        
    }

    public function asignarUsuario($nombre)
    {        
        $this->id_Infraccion = DB::table('TipoInfraccion')->where("descripcion", $nombre)->value("id_Infraccion");  

        $this->buscar = $nombre;          
        $this->picked = true;
    }


































    public function updatedBuscarTV()
    {
        $this->pickedTV = false;


        $this->TipoVehiculos = DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->where("Descripcion", "like", trim($this->buscarTV) . "%")
            ->take(2)
            ->get();
        
    }

    public function asignarUsuarioTV($nombre)
    {        
        $this->buscarTV = $nombre;          
        $this->pickedTV = true;
    }


    public function updatedBuscarM()
    {
        $this->picked1 = false;


        $this->Marcas = DB::connection('Circulacion')->table('Marcas')->where("Descripcion", "like", trim($this->buscarM) . "%")
            ->take(2)
            ->get();
        
    }

    public function asignarUsuarioM($nombre)
    {        

        $this->buscarM = $nombre;          
        $this->picked1 = true;
    }

    public function render() 
    {
        if ($this->Rut!=0) { 
             
            $this->Ciudadano = DB::table('Ciudadanos')->select('NombresC','Apellidos')->where('Rut', $this->Rut)->get();
        }
        else{
            
            $this->Ciudadano='No Identificado'; 
        }

        $this->Testigo = DB::table('Inspectores')->select('id_inspector','Nombres','Apellidos')->where('Activo', '1')->get();

        $this->sqlPatentes = DB::connection('Circulacion')->table('Datos_del_Vehiculo')
            ->leftjoin('Tipos_de_Vehiculos', 'Datos_del_Vehiculo.Tipo_Vehiculo', '=', 'Tipos_de_Vehiculos.Codigo')
            ->leftjoin('Marcas', 'Datos_del_Vehiculo.Codigo_Marca', '=', 'Marcas.Codigo')
            ->select('Tipos_de_Vehiculos.Descripcion AS TipoVehiculo','Marcas.Descripcion as Marca','Modelo','Color')
            ->where('Datos_del_Vehiculo.Placa', '=', $this->Patente)
            ->get();

        $this->IdMultaingresar = IngresoMultaModel::orderBy('Id_Multas', 'desc')->first()->Id_Multas;

        $this->IdMultaingresar = $this->IdMultaingresar + 1;
       
        return view('livewire.multa-vehicular.agregar-multa',[
            'IdMultaingresar'=>$this->IdMultaingresar, 
            'Patente'=>$this->Patente, 
            'Ciudadano'=>$this->Ciudadano, 
            'Testigo'=>$this->Testigo, 
            'NoIdentificado'=>$this->NoIdentificado, 
            'sqlPatentes'=>$this->sqlPatentes,  
            'Rut'=>$this->Rut,
            'TipoVehiculos'=> DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->where('Descripcion', 'like', '%'.$this->TipoVehiculo.'%')->orderBy('Descripcion', 'asc')->get(),
            'Juzgado'=>$this->Juzgado = DB::table('Juzgado')->get(),
            'Infraccion'=>$this->Infraccion = DB::table('TipoInfraccion')->get(),
		])->layout('Posts.MultaVehicular.PostsAgregarMulta');
 
    }
}  
