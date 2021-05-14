<?php

namespace App\Http\Livewire\MultaVehicular;
 
use Livewire\Component;
use Illuminate\Support\Facades\DB;  
use App\Models\IngresoMultaModel; 
use Illuminate\Http\Request;
use App\Models\IngVehiculoModel;
use App\Models\TipoVehiculo;
use App\Models\IngTestigos;  
use App\Models\Imagenes;  

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;


class AgregarMulta extends Component
{

    use WithFileUploads;

    //Imagen
    public $photo;
    public $Patente;
    public $sqlPatentes='0';
    public $Numero;  

    //Datos del vehiculo
    public $Encontrado_Codigo;
    public $TipoVehiculo; 
    public $Marca;  
    public $Modelo;
    public $Color;


    //Mostrar datos
    public $Mostrar='0';
    
    protected $ValidarPatente = ['Patente' => 'required'];
    
    protected $PatenteMessages = ['Patente.required' =>'El campo "Patente" es obligatorio.'];

    public function AgregarPatente()
    {
        $this->validate($this->ValidarPatente,$this->PatenteMessages); 
    
        $this->sqlPatentes = DB::connection('Circulacion')->table('Datos_del_Vehiculo')
            ->leftjoin('Tipos_de_Vehiculos', 'Datos_del_Vehiculo.Tipo_Vehiculo', '=', 'Tipos_de_Vehiculos.Codigo')
            ->leftjoin('Marcas', 'Datos_del_Vehiculo.Codigo_Marca', '=', 'Marcas.Codigo')
            ->select('Tipos_de_Vehiculos.Descripcion AS TipoVehiculo','Marcas.Descripcion as Marca','Modelo','Color','Tipos_de_Vehiculos.Codigo AS TVCodigo')
            ->where('Datos_del_Vehiculo.Placa', '=', $this->Patente)
            ->get();

        $this->Numero=count($this->sqlPatentes);

        foreach ($this->sqlPatentes as $key) {
            $this->Encontrado_Codigo = $key->TVCodigo;
            $this->TipoVehiculo = $key->TipoVehiculo;
            $this->Marca = $key->Marca;
            $this->Modelo = $key->Modelo;
            $this->Color = $key->Color;
        }

        $this->Mostrar='1';
    } 

    //Datos citacion
    public $id_Juzgado;
    public $FechaCitacion;

    //Datos Infracción
    public $Ingreso_TipoInfraccion;
    public $Ingreso_Lugar;
    public $Ingreso_Articulo;
    public $Ingreso_Testigo;
 
    //Rut Ciudadano
    public $Rut; 

    public $TipoNotificacion; 

    public $IdMultaIngresada; 

    public $MultaIngresada='0';
 
    protected $rules = [
        'Patente' => 'required', 
        'TipoVehiculo' => 'required', 
        'Marca' => 'required',
        'Modelo' => 'required',
        'Color' => 'required', 
        'id_Juzgado' => 'required', 
        'FechaCitacion' => 'required', 
        'Ingreso_TipoInfraccion' => 'required',
        'Ingreso_Lugar' => 'required',
        'Ingreso_Articulo' => 'required', 
        'Ingreso_Testigo' => 'required', 
    ];

    protected $messages = [
        'Patente.required' =>'El campo Patente es obligatorio.',
        'TipoVehiculo.required' =>'El campo Tipo Vehiculo es obligatorio.',
        'Marca.required' =>'El campo Marca es obligatorio.',
        'Modelo.required' =>'El campo Modelo es obligatorio.',
        'Color.required' =>'El campo Color es obligatorio.',
        'FechaCitacion.required' =>'El campo Fecha Citación es obligatorio.',
        'Ingreso_TipoInfraccion.required' =>'El campo Tipo Infracción es obligatorio.',
        'Ingreso_Lugar' =>'El campo Lugar es obligatorio.',
        'Ingreso_Articulo.required' =>'El campo Infracción Articulo es obligatorio.',
        'Ingreso_Testigo.required' =>'El campo Testigo es obligatorio.',
    ];


    protected $rules2 = [
        'Patente' => 'required', 
        'TipoVehiculo' => 'required', 
        'Marca' => 'required',
        'Modelo' => 'required',
        'Color' => 'required', 
        'id_Juzgado' => 'required', 
        'Ingreso_TipoInfraccion' => 'required',
        'Ingreso_Lugar' => 'required',
        'Ingreso_Articulo' => 'required', 
        'Ingreso_Testigo' => 'required', 
    ];

    protected $messages2 = [
        'Patente.required' =>'El campo Patente es obligatorio.',
        'TipoVehiculo.required' =>'El campo Tipo Vehiculo es obligatorio.',
        'Marca.required' =>'El campo Marca es obligatorio.',
        'Modelo.required' =>'El campo Modelo es obligatorio.',
        'Color.required' =>'El campo Color es obligatorio.',
        'Ingreso_TipoInfraccion.required' =>'El campo Tipo Infracción es obligatorio.',
        'Ingreso_Lugar' =>'El campo Lugar es obligatorio.',
        'Ingreso_Articulo.required' =>'El campo Infracción Articulo es obligatorio.',
        'Ingreso_Testigo.required' =>'El campo Testigo es obligatorio.',
    ];

    public function IngresoMulta(){

        if ($this->TipoNotificacion!='2') {
            $this->validate();
        }
        else{
            $this->validate($this->rules2,$this->messages2); 
        }
                $ExisteTipoVehiculos = DB::table('TipoVehiculo')->select('id_Codigo')->where('id_Codigo', '=', $this->Encontrado_Codigo)->get();
               
                $TipoVehiculos_Numero=count($ExisteTipoVehiculos);
                
                if($TipoVehiculos_Numero=='0'){
                    
                    $TipoVehiculos= DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->select('Descripcion')->where('Codigo', '=', $this->Encontrado_Codigo)->get();
                    
                    foreach ($TipoVehiculos as $key) {
                        $Descripcion= $key->Descripcion;
                    }

                    $Vehiculo                 = new TipoVehiculo;
                    $Vehiculo->id_Codigo      = $this->Encontrado_Codigo;
                    $Vehiculo->Descripcion_TV = $Descripcion;
                    $Vehiculo->save();         

                }

                $IdPatente = IdPatente($this->Patente); 
            
 
                if($IdPatente=='[]'){  
                     
                    $Vehiculo                 = new IngVehiculoModel;
                    $Vehiculo->PlacaPatente   = $this->Patente;
                    $Vehiculo->TipoVehiculo   = $this->Encontrado_Codigo;
                    $Vehiculo->Marca          = $this->Marca;
                    $Vehiculo->Modelo         = $this->Modelo;
                    $Vehiculo->Color          = $this->Color;
                    $Vehiculo->save();

                    $IdPatente = IdPatente($this->Patente);
                }

                $AnioActual = date("y"); 

           

            $ID = IngresoMultaModel::select('NumeroParte','Anio')
                ->where('Id_Juzgado' ,'=', $this->id_Juzgado)
                ->orderBy('Id_Multas', 'DESC')->first();

            if ($ID==null) {
                $AnioMulta        = $AnioActual; 
                $NumeroParteIngr  = '0';
            }
            else{
                $AnioMulta        = $ID->Anio; 
                $NumeroParteIngr  = $ID->NumeroParte;
            
            }
          
            if ($AnioMulta==0) {
                $AnioMulta = date("y"); 
            }
                 
            if ($AnioMulta==$AnioActual){ 
                
                $NumeroParteIngr=$NumeroParteIngr+1;
            }
            else{
                
                $NumeroParteIngr=0;
            }

            $id_Ciudadano = id_Ciudadano($this->Rut);

            $Multa                        = new IngresoMultaModel();

            if ($this->TipoNotificacion=='3') {
               $Multa->Id_Ciudadanos      = $id_Ciudadano;
               //Escrito 
               $Multa->TipoNotificacion   = '3';  
            }
            elseif($this->TipoNotificacion=='2'){ 
                //Personalmente
                $Multa->TipoNotificacion   = '2'; 
            } 
            else{

                $Multa->TipoNotificacion   = '1'; 
            } 


            $id_inspector=Auth::user()->id_inspector;  

            $Multa->Parte              = $this->id_Juzgado.$NumeroParteIngr.$AnioMulta;
            $Multa->NumeroParte        = $NumeroParteIngr;
            $Multa->Anio               = $AnioMulta;
            $Multa->Id_Inspector       = $id_inspector;
            $Multa->Id_Juzgado         = $this->id_Juzgado;
            $Multa->id_TipoInfraccion  = $this->Ingreso_TipoInfraccion;
            $Multa->Id_Vehiculo        = $IdPatente;
            $Multa->Lugar              = $this->Ingreso_Lugar;
            $Multa->Hora               = date('H:i:s');
            $Multa->InfraccionArticulo = $this->Ingreso_Articulo;
            $Multa->Fecha              = date("Y/m/d");
            $Multa->FechaCitacion      = $this->FechaCitacion;
            $Multa->EstadoMulta        = '0';
            $Multa->save(); 
        
            $this->IdMultaIngresada = IngresoMultaModel::orderBy('Id_Multas', 'desc')->first()->Id_Multas;
           
            $IngTestigo                     = new IngTestigos;
            $IngTestigo->id_Multas_T        = $this->IdMultaIngresada;
            $IngTestigo->Id_Inspectores     = $this->Ingreso_Testigo;
            $IngTestigo->save();
            
            if(!empty($this->photo)){
            
                $nommbreArchivo = $this->photo->store('images');
                
                $Imagenes                 = new Imagenes;
                $Imagenes->Id_Multa_Tabla = $this->IdMultaIngresada;
                $Imagenes->RutaImagen     = $nommbreArchivo;
                $Imagenes->save();
            }

            $this->MultaIngresada='1';                        

    }
   
    //Ver si borro
    public $Infraccion;  
    public $id_Articulo;
    public $IdMultaingresar;
    public $Ciudadano; 
    public $NoIdentificado; 
    public $NombreJuzgado;
    public $NumeroParte;
    public $Articulo;
    public $buscarTI;
    public $buscarArt;
    public $Testigo;
  

    public function render() 
    {
        if ($this->Rut!=0) { 
             
            $this->Ciudadano = DB::table('Ciudadanos')->select('NombresC','Apellidos')->where('Rut', $this->Rut)->get();
        
        }
        else{
            
            $this->Ciudadano='No Identificado'; 
        
        } 

        $this->Testigo = DB::table('Inspectores')->select('id_inspector','Nombres','Apellidos')->where('Activo', '1')->get();

        
        
        $NumeroParte = DB::table('Multas')
            ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
            ->select('NumeroParte')
            ->where('Juzgado.Activo', '=', '1')
            ->get();

        foreach ($NumeroParte as $key) {
            $this->NumeroParte= $key->NumeroParte+1;
        }

        $IdMulta = IngresoMultaModel::select('Id_Multas')->orderBy('Id_Multas', 'desc')->first();

        if(empty($IdMulta->Id_Multas)){

            $this->IdMultaingresar =  1;  
        }
        else{
            
            $this->IdMultaingresar = $IdMulta->Id_Multas + 1;
        }
        
        $this->NombreJuzgado = DB::table('Juzgado')->select('id_Juzgado','NombreJuzgado')->where('Activo', '=', '1')->get();

        foreach ($this->NombreJuzgado as $key) {
            $this->NombreJuzgado = $key->NombreJuzgado;
            $this->id_Juzgado = $key->id_Juzgado;
        }


        return view('livewire.multa-vehicular.agregar-multa',[
            'TipoVehiculos'=> DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->orderBy('Descripcion', 'asc')->get(),
            'Marcas' => DB::connection('Circulacion')->table('Marcas')->orderBy('Descripcion', 'asc')->get(),

            'NumeroParte'=>$this->NumeroParte, 
            'IdMultaingresar'=>$this->IdMultaingresar, 
            'Patente'=>$this->Patente, 
            'NombreJuzgado'=>$this->NombreJuzgado, 
            'id_Juzgado'=>$this->id_Juzgado, 
            'Ciudadano'=>$this->Ciudadano, 
            'Testigo'=>$this->Testigo, 
            'NoIdentificado'=>$this->NoIdentificado, 
            'Rut'=>$this->Rut,
            
            'InfraccionesArt' => DB::table('Articulo')->orderBy('NombreArt', 'asc')->get(),


            'Infracciones' => DB::table('TipoInfraccion')->orderBy('descripcion', 'asc')->get(),
            'Juzgado' => DB::table('Juzgado')->where('Activo', '=', '1')->get(),
         
		])->layout('Posts.MultaVehicular.PostsAgregarMulta');
 
    }
}  
 