<?php

namespace App\Http\Controllers\MultaVehicular;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IngresoMultaModel; 
use App\Models\IngVehiculoModel;
use App\Models\IngTestigos;    
use Illuminate\Support\Facades\Auth;

class IngresoMultaController extends Controller
{
     public function index(Request $request)
    {     
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

        $Rut = $request->input('Rut');
        $Patente = $request->input('Patente');
        
        $TipoVehiculo = $request->input('TipoVehiculo');
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
        $Fotos = $request->input('Fotos'); 



        $N_Multa=DB::table('Multas')->select('Id_Multas')->where('Id_Multas', '=', $IdMultaingresar)->get()->count();

        if($N_Multa==0)
        { 
            $id_Ciudadano = id_Ciudadano($Rut);
            
            $IdPatente = IdPatente($Patente); 
            
            if($IdPatente=='[]'){ 
                 
                $Vehiculo                 = new IngVehiculoModel;
                $Vehiculo->PlacaPatente   = $Patente;
                $Vehiculo->TipoVehiculo   = $TipoVehiculo;
                $Vehiculo->Marca          = $Marca;
                $Vehiculo->Modelo         = $Modelo;
                $Vehiculo->Color          = $Color;
                $Vehiculo->save();

                $IdPatente = IdPatente($Patente);
            }

            $id_inspector=Auth::user()->id_inspector; 

            $Multa 				       = new IngresoMultaModel();

            if ($id_Ciudadano!='[]') {
               $Multa->Id_Ciudadanos      = $id_Ciudadano;
               //Escrito
               $Multa->TipoNotificacion   = '1';  
            }
            else{
                //Personalmente
                $Multa->TipoNotificacion   = '2'; 
            }
        	 
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
         
        return view('Sistema/MultaIngresada')->with('datos', $datos)->with('Testigo', $Testigo);

    }
}
