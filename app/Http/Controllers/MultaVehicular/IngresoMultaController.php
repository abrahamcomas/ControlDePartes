<?php

namespace App\Http\Controllers\MultaVehicular;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IngresoMultaModel; 
use App\Models\IngVehiculoModel;
use App\Models\TipoVehiculo;
use App\Models\IngTestigos;    
use Illuminate\Support\Facades\Auth;

class IngresoMultaController extends Controller
{
     public function index(Request $request)
    {     
         $Rut = $request->input('Rut');


    	$rules = [   
            'Patente' => 'required', 
            'TipoVehiculo' => 'required', 
            'Marca' => 'required',
            'Modelo' => 'required',
            'Color' => 'required', 
        ]; 

        $messages = [  
            'Patente.required' =>'El campo Patente es obligatorio.',
            'TipoVehiculo.required' =>'El campo Tipo Vehiculo es obligatorio.',
            'Marca.required' =>'El campo Marca es obligatorio.',
            'Modelo.required' =>'El campo Modelo es obligatorio.',
            'Color.required' =>'El campo Color es obligatorio.',
        ];

        // $this->validate($request, $rules, $messages)->with('Rut', $Rut);  
        $this->validate($request, $rules, $messages);  

        $Hora = $request->input('Hora');
        $Fecha = $request->input('Fecha');
        $Fecha = date("Y/m/d", strtotime($Fecha));

       
        $Patente = $request->input('Patente');
        
        $TipoVehiculo = $request->input('TipoVehiculo');
        $TVCodigo = $request->input('TVCodigo');

        $Marca = $request->input('Marca');
        $Modelo = $request->input('Modelo'); 
        $Color = $request->input('Color'); 
 
        $Juzgado = $request->input('Juzgado'); 
        $FechaCitacion = $request->input('FechaCitacion'); 
        $FechaCitacion = date("Y/m/d", strtotime($FechaCitacion));
        $IdMultaingresar = $request->input('IdMultaingresar'); 

        $TipoInfraccion = $request->input('TipoInfraccion'); 
        $Lugar = $request->input('Lugar'); 
        $Articulo = $request->input('Articulo');  
        $Testigo = $request->input('Testigo');   
        $Numero = $request->input('Numero');  
        $Foto = $request->input('Foto'); 

        $N_Multa=DB::table('Multas')->select('Id_Multas')->where('Id_Multas', '=', $IdMultaingresar)->get()->count();

        if($N_Multa==0)
        { 

            $TV=DB::table('TipoVehiculo')->where('id_Codigo', '=', $TVCodigo)->get()->count();

            if($TV==0){ 

                $Vehiculo                 = new TipoVehiculo;
                $Vehiculo->id_Codigo      = $TVCodigo;
                $Vehiculo->Descripcion_TV = $TipoVehiculo;
                $Vehiculo->save();
            }

            $id_Ciudadano = id_Ciudadano($Rut);
            
            $IdPatente = IdPatente($Patente); 
            
            if($IdPatente=='[]'){  
                 
                $Vehiculo                 = new IngVehiculoModel;
                $Vehiculo->PlacaPatente   = $Patente;
                $Vehiculo->TipoVehiculo   = $TVCodigo;
                $Vehiculo->Marca          = $Marca;
                $Vehiculo->Modelo         = $Modelo;
                $Vehiculo->Color          = $Color;
                $Vehiculo->save();

                $IdPatente = IdPatente($Patente);
            }

            $id_inspector=Auth::user()->id_inspector; 
            

            $AnioActual = date("y"); 

            $ID = IngresoMultaModel::select('NumeroParte','Anio')
                ->where('Id_Juzgado' ,'=', $Juzgado)
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

            $Multa 				          = new IngresoMultaModel();

            if ($id_Ciudadano!='[]') {
               $Multa->Id_Ciudadanos      = $id_Ciudadano;
               //Escrito
               $Multa->TipoNotificacion   = '1';  
            }
            else{ 
                //Personalmente
                $Multa->TipoNotificacion   = '2'; 
            } 

            $Multa->Parte              = $Juzgado.$NumeroParteIngr.$AnioMulta;
            $Multa->NumeroParte        = $NumeroParteIngr;
            $Multa->Anio               = $AnioMulta;
            $Multa->Id_Inspector       = $id_inspector;
            $Multa->Id_Juzgado 		   = $Juzgado;
            $Multa->id_TipoInfraccion  = $TipoInfraccion;
            $Multa->Id_Vehiculo        = $IdPatente;
            $Multa->Lugar              = $Lugar;
            $Multa->Hora   		       = $Hora;
            $Multa->InfraccionArticulo = $Articulo;
            $Multa->Fecha              = $Fecha;
            $Multa->FechaCitacion      = $FechaCitacion;
            $Multa->EstadoMulta        = '0';
            $Multa->save(); 
        

            $IdMulta = IngresoMultaModel::orderBy('Id_Multas', 'desc')->first()->Id_Multas;
           
            $IngTestigo                     = new IngTestigos;
            $IngTestigo->id_Multas_T        = $IdMulta;
            $IngTestigo->Id_Inspectores     = $Testigo;
            $IngTestigo->save();
        						 
        }

        $IdMulta = IngresoMultaModel::orderBy('Id_Multas', 'desc')->first()->Id_Multas;

        $datos =  DB::table('Multas') 
        ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
        ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
        ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
        ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
        ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
        ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
        ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
        ->select('Id_Multas','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','NombreArt','Hora','Nombres','Inspectores.Apellidos AS ApellidosInsp','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Profesion','NombreNac','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar')
        ->where('Multas.Id_Multas', '=', $IdMulta)->get();

        $Testigo =  DB::table('Multas') 
        ->leftjoin('Testigos', 'Multas.Id_Multas', '=', 'Testigos.id_Multas_T')
        ->leftjoin('Inspectores', 'Testigos.Id_Inspectores', '=', 'Inspectores.id_inspector')
        ->select('Nombres','Apellidos')
        ->where('Multas.Id_Multas', '=', $IdMulta)->get();

        $IDM = IngresoMultaModel::select('NumeroParte','Anio')
                ->where('Id_Juzgado' ,'=', $Juzgado)
                ->orderBy('Id_Multas', 'DESC')->first();
         
        return view('Sistema/MultaIngresada')->with('datos', $datos)->with('Testigo', $Testigo)->with('TipoInfraccion', $TipoInfraccion)->with('Juzgado', $Juzgado)
        ->with('NumeroParteIngr', $IDM->NumeroParte)->with('AnioMulta', $IDM->Anio);

    }
} 
