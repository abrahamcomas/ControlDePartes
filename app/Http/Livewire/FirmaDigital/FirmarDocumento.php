<?php

namespace App\Http\Livewire\FirmaDigital;

use Livewire\Component;
use Livewire\WithPagination; 
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Auth;

class FirmarDocumento extends Component
{ 
    use WithPagination;
  
    public $Id_Multas; 
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
      $id_inspector =Auth::guard('web')->user()->id_inspector ;
        
      $this->Datos =  DB::table('Multas') 
          ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
          ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
          ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
          ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
          ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
          ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
          ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
          ->select('Id_Multas','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','NombreArt','Hora','InfraccionArticulo','Nombres','Inspectores.Apellidos AS ApellidosInsp','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Ciudadanos.Rut AS RutCiudadano','Profesion','NombreNac','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar')
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
              ->select('Id_Multas','Firma','NumeroParte','Id_Juzgado','PlacaPatente','Ruta')
              ->where('Firma', '=', '0') 
              ->where('Estado', '=', '0') 
              ->where('Multas.Id_Inspector', '=', $id_inspector)
              ->paginate(5),
            'Datos'=>$this->Datos,
            'Imagenes'=>$this->Imagenes,
            'TipoFirma'=>$this->TipoFirma,
            'Testigo'=>$this->Testigo  
          ]);
    }
}
  