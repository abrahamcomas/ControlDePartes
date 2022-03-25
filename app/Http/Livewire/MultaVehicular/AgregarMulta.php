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
use App\Models\NumeroInfracciones;
use App\Models\BuscarMulta;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;

class AgregarMulta extends Component
{

    use WithFileUploads;

    public $Patente;
    public $sqlPatentes='0';
    public $Numero;  

    //Datos del vehiculo
    public $TipoVehiculo; 
    public $Marca;  
    public $Modelo;
    public $Color; 
    public $Encontrado_Codigo;
    
    //Mostrar datos
    public $Mostrar='0';
    
    public $MostrarPatente=1;
    
    protected $ValidarPatente = ['Patente' => 'required'];
    protected $PatenteMessages = ['Patente.required' =>'El campo "Patente" es obligatorio.'];

    public function AgregarPatente()
    {
        $this->validate($this->ValidarPatente,$this->PatenteMessages); 
        
        $this->MostrarPatente=0;
        
        $this->sqlPatentes = DB::connection('Circulacion')->table('Datos_del_Vehiculo')
            ->leftjoin('Tipos_de_Vehiculos', 'Datos_del_Vehiculo.Tipo_Vehiculo', '=', 'Tipos_de_Vehiculos.Codigo')
            ->leftjoin('Marcas', 'Datos_del_Vehiculo.Codigo_Marca', '=', 'Marcas.Codigo')
            ->select('Tipos_de_Vehiculos.Descripcion AS TipoVehiculo','Marcas.Descripcion as Marca','Modelo','Color','Tipos_de_Vehiculos.Codigo AS TVCodigo')
            ->where('Datos_del_Vehiculo.Placa', '=', $this->Patente)
            ->get();

        $this->Numero=count($this->sqlPatentes);
        
        if($this->Numero!='0'){

            foreach ($this->sqlPatentes as $key) {
                $this->Encontrado_Codigo = $key->TVCodigo;
                $this->TipoVehiculo = $key->TipoVehiculo;
                $this->Marca = $key->Marca;
                $this->Modelo = $key->Modelo;
                $this->Color = $key->Color;
            }

            $this->Mostrar='1';

        }
        else{

            $this->sqlPatentes = DB::table('Vehiculos')->where('PlacaPatente', '=', $this->Patente)->get();
            $this->Numero=count($this->sqlPatentes);
            
            foreach ($this->sqlPatentes as $key){
                $this->Encontrado_Codigo = $key->TipoVehiculo;
                $this->TipoVehiculo = $key->V_Descripcion;
                $this->Marca = $key->Marca;
                $this->Modelo = $key->Modelo;
                $this->Color = $key->Color;
            }

            $this->Mostrar='1';

        }

    }
    public $TipoPatente=1;
    public function CambiarVehiculo(){

        $this->TipoPatente++;
        $this->Patente="";

        if($this->TipoPatente==4){

            $this->TipoPatente=1;
        }
    }


    
    public function CambiarPatente(){

        $this->MostrarPatente=1;
        $this->Mostrar='0';
        $this->TipoVehiculo = '';
        $this->buscarTV = '';
        $this->Marca = '';
        $this->buscarM='';
        $this->Modelo = '';
        $this->Color = '';

    }

    //Buscadores

    //Tipo Vehiculo
    public $buscarTV;
    public $TipoVehiculos1;
    public $pickedTV;
    
    //Marca
    public $buscarM;
    public $Marcas;
    public $picked1;

    //TIPO INFRACCION
    public $buscar;
    public $Infracciones;
    public $picked;
    
    public function mount()
    {
        $this->buscarTV = "";
        $this->InfraccionesTV = [];
        $this->pickedTV = true;

        $this->buscarM = "";
        $this->Marcas = [];
        $this->picked1 = true;

        $this->buscar = "";
        $this->Infracciones = [];
        $this->picked = true;
    } 

    //BUSCADOR MODELOS
    public function updatedBuscarTV()
    {
        $this->pickedTV = false;


        $this->TipoVehiculos1 = DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->select('Descripcion')->where("Descripcion", "like", trim($this->buscarTV) . "%")
            ->take(3)
            ->get('Descripcion');  
    }

    public function asignarUsuarioTV($nombre)
    {        

        $T_V = DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->select('Codigo','Descripcion')->where('Descripcion', '=', $nombre)->get('Codigo','Descripcion');  
        
        foreach ($T_V as $key){
            $this->Encontrado_Codigo = $key->Codigo;
            $this->TipoVehiculo = $key->Descripcion;
        }

        $this->buscarTV = $nombre;  
        $this->pickedTV = true;
    }

    //BUSCADOR MARCAS
    public function updatedBuscarM()
    {
        $this->picked1 = false;

        $this->Marcas = DB::connection('Circulacion')->table('Marcas')->select('Descripcion')->where("Descripcion", "like", trim($this->buscarM) . "%")
            ->take(3)
            ->get('Descripcion');
        
    }

    public function asignarUsuarioM($nombre)
    {        
        $this->buscarM = $nombre;
        $this->Marca = $nombre;            
        $this->picked1 = true;
    }

   //BUSCADOR TIPO INFRACCION
    public $id_Infraccion;
    //Id_TipoInfraccion
    public $Ingreso_TipoInfraccion;

    public function updatedBuscar() 
    {
        $this->picked = false;
        
        /*$this->Infracciones = DB::table('TipoInfraccion')->select('descripcion')->where("descripcion", "like", trim($this->buscar) . "%")
            ->take(2)
            ->get('descripcion');*/

        $this->Infracciones = DB::table('TipoInfraccion')->select('descripcion')->where(function($query){ 
            $query->orwhere("Articulo", "like", trim($this->buscar) . "%")
                ->orwhere("descripcion", "like", trim($this->buscar) . "%");
            })->take(2)->get('descripcion');  
        
    }

    public function AsignarInfraccion($descripcion)
    {         
        $this->id_Infraccion = DB::table('TipoInfraccion')->select('id_Infraccion')->where("descripcion", $descripcion)->get();  
        
        foreach($this->id_Infraccion as $key){

             $this->Ingreso_TipoInfraccion=$key->id_Infraccion;
        }      
        
        $this->buscar = $descripcion;       
        $this->picked = true;
    }

    //INGRESO ARTICULO
    public $Ingreso_Articulo;
    public $DecLey;
    public $DetallesDecLey;



    public function ValorDecLey($Valor)
    {    
        if($Valor=='Decreto'){
            $this->DecLey= 'Decreto';

        }
        else{

            $this->DecLey= 'Ley';

        }
    }
    
    //Imagen
    public $photo; 
    
    //Datos citacion
    public $id_Juzgado;
    public $SeleccionadoJuzgado;
    public function Valorid_Juzgado($Valor)
    {    
        if($Valor=='1'){
            $this->id_Juzgado= '1';
            $this->SeleccionadoJuzgado= 'SELECCIONADO';

        }
        else{

            $this->id_Juzgado= '2';
            $this->SeleccionadoJuzgado= 'SELECCIONADO';

        }
    }


    public $FechaCitacion;
    public $Observacion;
    
    //Datos Infracción
    public $Ingreso_Lugar;
    public $Ingreso_Testigo;
    
    //Rut Ciudadano
    public $Rut; 
    public $Hora;
    public $TipoNotificacion; 
    public $IdMultaIngresada; 
    public $MultaIngresada='0';
    protected $rules = [
        'Patente' => 'required', 
        'Marca' => 'required',
        'Color' => 'required', 
        'id_Juzgado' => 'required', 
        'FechaCitacion' => 'required', 
        'Ingreso_TipoInfraccion' => 'required',
        'Ingreso_Lugar' => 'required',
        'DecLey' => 'required',
        'DetallesDecLey' => 'required', 
        'Ingreso_Testigo' => 'required', 
    ];

    protected $messages = [
        'Patente.required' =>'El campo Patente es obligatorio.',
        'Marca.required' =>'El campo Marca es obligatorio.',
        'Color.required' =>'El campo Color es obligatorio.',
        'id_Juzgado.required' =>'El campo Juzgado es obligatorio.',
        'FechaCitacion.required' =>'El campo Fecha Citación es obligatorio.',
        'Ingreso_TipoInfraccion.required' =>'El campo Tipo Infracción es obligatorio.',
        'Ingreso_Lugar' =>'El campo Lugar es obligatorio.',
        'DecLey.required' => 'El campo Decreto o Ley Articulo es obligatorio.',
        'DetallesDecLey.required' => 'El campo Detalles Articulo es obligatorio.', 
        'Ingreso_Testigo.required' =>'El campo Testigo es obligatorio.',
    ];


    protected $rules2 = [
        'Patente' => 'required', 
        'Marca' => 'required',
        'Color' => 'required', 
        'id_Juzgado' => 'required', 
        'Hora' => 'required', 
        'Ingreso_TipoInfraccion' => 'required',
        'Ingreso_Lugar' => 'required',
        'DecLey' => 'required',
        'DetallesDecLey' => 'required', 
        'Ingreso_Testigo' => 'required', 
    ];

    protected $messages2 = [
        'Patente.required' =>'El campo Patente es obligatorio.',
        'Marca.required' =>'El campo Marca es obligatorio.',
        'Color.required' =>'El campo Color es obligatorio.',
        'Hora.required' =>'El campo Hora es obligatorio.',
        'Ingreso_TipoInfraccion.required' =>'El campo Tipo Infracción es obligatorio.',
        'Ingreso_Lugar' =>'El campo Lugar es obligatorio.',
        'DecLey.required' => 'El campo Decreto o Ley Articulo es obligatorio.',
        'DetallesDecLey.required' => 'El campo Detalles Articulo es obligatorio.', 
        'Ingreso_Testigo.required' =>'El campo Testigo es obligatorio.',
    ];

    public function IngresoMulta()
    {

            if ($this->TipoNotificacion!='2') {
                $this->validate();
            } 
            else{
                $this->validate($this->rules2,$this->messages2); 
            }
                    

                  if($this->Encontrado_Codigo!=null)
                  {

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
                            $Vehiculo->V_Descripcion  = $this->TipoVehiculo;
                            $Vehiculo->Modelo         = $this->Modelo;
                            $Vehiculo->Color          = $this->Color;
                            $Vehiculo->save();
                        }


                  }
                  else{


                        $ExisteTipoVehiculos = DB::table('TipoVehiculo')->select('id_Codigo')->where('id_Codigo', '=', $this->TipoVehiculo)->get();
                                
                        $TipoVehiculos_Numero=count($ExisteTipoVehiculos);
                            
                        if($TipoVehiculos_Numero=='0'){
                                  
                            $TipoVehiculos= DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->select('Descripcion')->where('Codigo', '=', $this->TipoVehiculo)->get();
                                    
                                foreach ($TipoVehiculos as $key) {
                                    $Descripcion= $key->Descripcion;
                                }

                                if(!empty($Descripcion)){

                                    $Vehiculo                 = new TipoVehiculo;
                                    $Vehiculo->id_Codigo      = $this->TipoVehiculo;
                                    $Vehiculo->Descripcion_TV = $Descripcion;
                                    $Vehiculo->save();    
                                }

                 
                          

                        }

                        $IdPatente = IdPatente($this->Patente); 

                        if($IdPatente=='[]'){   
                                         
                            $Vehiculo                 = new IngVehiculoModel;
                            $Vehiculo->PlacaPatente   = $this->Patente;
                            $Vehiculo->TipoVehiculo   = $this->TipoVehiculo;
                            $Vehiculo->Marca          = $this->Marca;
                            $Vehiculo->V_Descripcion  = $this->TipoVehiculo;
                            $Vehiculo->Modelo         = $this->Modelo;
                            $Vehiculo->Color          = $this->Color;
                            $Vehiculo->save();
                        }


                  }

            $IdPatente = IdPatente($this->Patente); 
                    
            $AnioActual = date("y");  

            $id_inspectorDireccion = Auth::user()->Id_Direccion_T;

            $ID = NumeroInfracciones::select('NumeroParte','Anio')
                    ->where('Id_Direccion_T' ,'=', $id_inspectorDireccion)
                    ->where('Id_Juzgado' ,'=', $this->id_Juzgado)
                    ->where('Anio' ,'=', $AnioActual)
                    ->orderBy('Id_Infracciones', 'DESC')->first();


                    
                if ($ID==null) {
                    $NumeroParteIngr  = '0';
                    $AnioMulta        = $AnioActual; 
             
                }
                else{
                    $NumeroParteIngr  = $ID->NumeroParte;
                    $AnioMulta        = $ID->Anio; 
                   
                
                }
                
                /*if ($AnioMulta==0) {
                    $AnioMulta = date("y"); 
                }*/
                     
                if ($AnioMulta==$AnioActual){ 
                    
                    $NumeroParteIngr=$NumeroParteIngr+1;
                }
                else{
                    
                    $NumeroParteIngr=0;
                }
           
                $NumeroInfracciones                  = new NumeroInfracciones();
                $NumeroInfracciones->Id_Direccion_T  = $id_inspectorDireccion;
                $NumeroInfracciones->Id_Juzgado      = $this->id_Juzgado;
                $NumeroInfracciones->NumeroParte     = $NumeroParteIngr;
                $NumeroInfracciones->Anio            = $AnioMulta;
                $NumeroInfracciones->save();

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

                $Multa->Firma              = "0";
                $Multa->Estado             = "0";
                $Multa->Parte              = $this->id_Juzgado.$NumeroParteIngr.$AnioMulta;
                $Multa->NumeroParte        = $NumeroParteIngr;
                $Multa->Anio               = $AnioMulta;
                $Multa->Id_Inspector       = $id_inspector;
                $Multa->Id_Juzgado         = $this->id_Juzgado;
                $Multa->id_TipoInfraccion  = $this->Ingreso_TipoInfraccion;
                $Multa->Id_Vehiculo        = $IdPatente;
                $Multa->Lugar              = $this->Ingreso_Lugar;
                
                if ($this->TipoNotificacion=='2') {
                    $Multa->Hora               = $this->Hora;
                 }
                 else{
 
                    $Multa->Hora               = date('H:i:s');
                 } 
                
                $Multa->InfraccionArticulo = $this->Ingreso_Articulo;
                $Multa->DecLey             = $this->DecLey;
                $Multa->DetallesDecLey     = $this->DetallesDecLey;
                $Multa->Fecha              = date("Y/m/d");
                $Multa->FechaCitacion      = $this->FechaCitacion;
                $Multa->EstadoMulta        = '0';
                $Multa->Observacion        = $this->Observacion;
                $Multa->save(); 

                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $Token1 = substr(str_shuffle($permitted_chars), 0, 30);
                $Token2 = substr(str_shuffle($permitted_chars), 0, 30);

                $BuscarMulta             = new BuscarMulta;
                $BuscarMulta->Multa      = $Multa->Id_Multas;
                $BuscarMulta->Token1     = $Token1;
                $BuscarMulta->Token2     = $Token2;
                $BuscarMulta->save();

            
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
                    
                    
                    Image::make($nommbreArchivo)->resize(800, 600)->save($nommbreArchivo);
                    
                }

            $this->MultaIngresada='1';                        
    
   }

    public $IdMultaingresar;
    public $Ciudadano; 
    public $NoIdentificado; 
    public $NombreJuzgado;
    public $NumeroParte;
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


        $IdMulta = IngresoMultaModel::select('Id_Multas')->orderBy('Id_Multas', 'desc')->first();

        if(empty($IdMulta->Id_Multas)){

            $this->IdMultaingresar =  1;   
        }
        else{
            
            $this->IdMultaingresar = $IdMulta->Id_Multas + 1;
        }

        return view('livewire.multa-vehicular.agregar-multa',[
            'TipoVehiculos'=> DB::connection('Circulacion')->table('Tipos_de_Vehiculos')->orderBy('Descripcion', 'asc')->get(),
            'Marcas' => DB::connection('Circulacion')->table('Marcas')->orderBy('Descripcion', 'asc')->get(),

          
            'IdMultaingresar'=>$this->IdMultaingresar, 
            'Patente'=>$this->Patente, 
           
            'Ciudadano'=>$this->Ciudadano, 
            'Testigo'=>$this->Testigo, 
            'NoIdentificado'=>$this->NoIdentificado, 
            'Rut'=>$this->Rut,
            'InfraccionesArt' => DB::table('Articulo')->orderBy('NombreArt', 'asc')->get(),
            'Infracciones' => DB::table('TipoInfraccion')->orderBy('descripcion', 'asc')->get(),
            'Juzgado' => DB::table('Juzgado')->get(),
         
		])->layout('Posts.MultaVehicular.PostsAgregarMulta');
 
    }
}  
 