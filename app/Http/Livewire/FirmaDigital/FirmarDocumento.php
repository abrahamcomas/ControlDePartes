<?php

namespace App\Http\Livewire\FirmaDigital;

use Livewire\Component;
use Livewire\WithPagination; 
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Auth;
use App\Models\IngVehiculoModel; 
use App\Models\TipoVehiculo;

class FirmarDocumento extends Component
{ 
    use WithPagination; 
  
    public $Id_Multas;  
    public $EditarMulta='0'; 
    public $Testigo;
    public $Datos; 
    public $id_inspector; 
    public $TipoFirma;
    public $Principal='0';  
    public $Detalles='0'; 
    public $ConfirmarIngreso='0';
    public function M_Detalles($Id_Multas)
    {
        $this->Id_Multas=$Id_Multas; 
        $this->Principal='1';
        $this->Detalles='1';
    } 

    public $EditarTipoVehiculo;
    public $EditarMarca;
    public $EditarModelo;
    public $EditarColor;
    
  
  public $Id_Vehiculo;
  public $PlacaPatente;
  public $M_EditarTipoVehiculo;
  public $M_EditarMarca;
  public $M_EditarModelo;
  public $M_EditarColor;
    
  public function Editar($Id_Multas)
    {
      $this->EditarMulta='1';
      $this->Principal='1';
      $this->Detalles='0';

      $this->DatosEditar =  DB::table('Multas') 
          ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
          ->select('Multas.Id_Vehiculo as Id_Vehicu','PlacaPatente','V_Descripcion','Marca','Modelo','Color')
          ->where('Multas.Id_Multas', '=', $Id_Multas)->get();

          foreach ($this->DatosEditar as $key) {
            $this->Id_Vehiculo = $key->Id_Vehicu;
            $this->PlacaPatente= $key->PlacaPatente;
            $this->M_EditarTipoVehiculo= $key->V_Descripcion;
            $this->M_EditarMarca= $key->Marca;
            $this->M_EditarModelo= $key->Modelo;
            $this->M_EditarColor= $key->Color;
        }
    } 

    public function InsertEditar() 
    {  

      if($this->EditarTipoVehiculo!=''){
        
       
        $TipoVehiculos= DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->select('Codigo','Descripcion')->where('Codigo', '=', $this->EditarTipoVehiculo)->get();
              
        foreach ($TipoVehiculos as $key) {
          $Codigo= $key->Codigo;
          $Descripcion= $key->Descripcion;
        }
        
        $ExisteTipoVehiculos = DB::table('TipoVehiculo')->select('id_Codigo')->where('id_Codigo', '=', $this->EditarTipoVehiculo)->get();
        $TipoVehiculos_Numero=count($ExisteTipoVehiculos);
        if($TipoVehiculos_Numero=='0'){   
        
          $Vehiculo                 = new TipoVehiculo;
          $Vehiculo->id_Codigo      = $Codigo;
          $Vehiculo->Descripcion_TV = $Descripcion;
          $Vehiculo->save();     
  
        }

       
    
      }
    
      $user =IngVehiculoModel::find($this->Id_Vehiculo);
			
      if($this->EditarTipoVehiculo!=''){
			    $user->TipoVehiculo  	=$Codigo;
      }
      if($this->EditarMarca!=''){
			  $user->Marca 		      =$this->EditarMarca;
      }
		
      if($this->EditarTipoVehiculo!=''){
        $user->V_Descripcion 	=$Descripcion;
      }
      
      if($this->EditarModelo!=''){
        $user->Modelo  	      =$this->EditarModelo;
      }
			
      if($this->EditarColor!=''){
			$user->Color  	      =$this->EditarColor;
      }
      
      
      
      $user->save();
      
      $this->EditarTipoVehiculo='';
      $this->EditarMarca='';
      $this->EditarModelo='';
      $this->EditarColor='';
      
      $this->EditarMulta='0';
      $this->Principal='0';
      $this->Detalles='0';


    }

    
    public function VolverEditar()
    {
      $this->EditarMulta='0';
      $this->Principal='0';
      $this->Detalles='0';

      $this->EditarTipoVehiculo= "";
      $this->EditarMarca= "";
      $this->EditarModelo= "";
      $this->EditarColor= "";
    }
    
    public function VolverDetalles()
    {
        $this->Principal='0';
        $this->Detalles='0';
    }

    public function ConfirmarIng($Id_Multas)
    {
        $this->Id_Multas=$Id_Multas; 
        $this->ConfirmarIngreso='1';
        $this->Principal='1';
        $this->Detalles='0';  
    }

  public function CancelarConfirmarIngreso()
    {
        $this->ConfirmarIngreso='0'; 
        $this->Principal='0';
        $this->Detalles='0'; 
    }

  protected $paginationTheme = 'bootstrap';
    public function render()
    { 
      $id_inspector =Auth::guard('web')->user()->id_inspector; 
        
      $this->Datos =  DB::table('Multas') 
          ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
          ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
          ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
          ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
          ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
          ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
          ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
          ->select('Id_Multas','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','NombreArt','Hora','InfraccionArticulo','DecLey','DetallesDecLey','Nombres','Inspectores.Apellidos AS ApellidosInsp','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Ciudadanos.Rut AS RutCiudadano','Profesion','NombreNac','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar')
          ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();
  
        $this->TipoFirma =  DB::table('Inspectores')
          ->select('TipoFirma')
          ->where('id_inspector', '=', $id_inspector)->get();
  
        $this->Imagenes =  DB::table('Imagenes')
          ->leftjoin('Multas', 'Imagenes.Id_Multa_Tabla', '=', 'Multas.Id_Multas')
          ->where('Id_Multa_Tabla', '=', $this->Id_Multas)->get();
  
        $this->Testigo =  DB::table('Multas')  
          ->leftjoin('Testigos', 'Multas.Id_Multas', '=', 'Testigos.id_Multas_T')
          ->leftjoin('Inspectores', 'Testigos.Id_Inspectores', '=', 'Inspectores.id_inspector')
          ->select('Nombres','Apellidos')
          ->where('Multas.Id_Multas', '=', $this->Id_Multas)->get();
          
        return view('livewire.firma-digital.firmar-documento',[
            'posts' =>  DB::table('Multas') 
              ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
              ->leftjoin('Document', 'Multas.Id_Multas', '=', 'Document.id_Multa_T')
              ->select('Id_Multas','Firma','Parte','NumeroParte','Id_Juzgado','PlacaPatente','Ruta')
              ->where('Firma', '=', '0') 
              ->where('Estado', '=', '0') 
              ->where('Multas.Id_Inspector', '=', $id_inspector)
              ->paginate(5),
            'TipoVehiculos'=> DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->orderBy('Descripcion', 'asc')->get(),
            'Marcas' => DB::connection('Circulacion')->table('Marcas')->orderBy('Descripcion', 'asc')->get(),
            'Juzgado' => DB::table('Juzgado')->get(),
            'Infracciones' => DB::table('TipoInfraccion')->orderBy('descripcion', 'asc')->get(),
            'Datos'=>$this->Datos,
            'Imagenes'=>$this->Imagenes,
            'TipoFirma'=>$this->TipoFirma,
            'Testigo'=>$this->Testigo  
          ]);
    }
}
  