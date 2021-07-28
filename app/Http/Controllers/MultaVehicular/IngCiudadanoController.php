<?php

namespace App\Http\Controllers\MultaVehicular;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IngCiudadanoModel; 
use Illuminate\Support\Facades\DB;

class IngCiudadanoController extends Controller
{
    public function index(Request $request)
    { 

        $TipoNotificacion = $request->input('TipoNotificacion');

        if ($TipoNotificacion==3) 
        {
                 
        	$rules = [ 
                'Rut' => 'required', 
                'Nombres' => 'required', 
                'Apellidos' => 'required',
                'Profesion' => 'required',
                'Nacionalidad' => 'required',
                'FechaNacimiento' => 'required',
                'Domicilio' => 'required', 
                'Licencia' => 'required',  
            ];

            $messages = [
                'Rut.required' =>'El campo Rut es obligatorio.',
                'Nombres.required' =>'El campo Nombres es obligatorio.',
                'Apellidos.required' =>'El campo Apellidos es obligatorio.',
                'Profesion.required' =>'El campo Profesion es obligatorio.',
                'Nacionalidad.required' =>'El campo Nacionalidad es obligatorio.',
                'FechaNacimiento.required' =>'El campo Fecha Nacimiento es obligatorio.',
                'Domicilio.required' =>'El campo Domicilio es obligatorio.',
                'Licencia.required' =>'El campo Licencia es obligatorio.'
            ]; 

            $this->validate($request, $rules, $messages);  

            $Rut = $request->input('Rut');
            $Nombres = $request->input('Nombres');
            $Apellidos = $request->input('Apellidos');
            $Profesion = $request->input('Profesion');
            $Nacionalidad = $request->input('Nacionalidad');
            $FechaNacimiento = $request->input('FechaNacimiento');
            $Domicilio = $request->input('Domicilio');
            $Licencia = $request->input('Licencia');

            $Ciudadano=IngCiudadanoModel::select('Rut')->whereRut($Rut)->first();
        
            if( (!isset($Ciudadano->Rut)) ) 
            {
            	$user 					= new IngCiudadanoModel;
            	$user->Rut  			= $Rut;
                $user->NombresC 		= $Nombres;
                $user->Apellidos		= $Apellidos;
                $user->Profesion  		= $Profesion;
                $user->ID_Nacionalidad  = $Nacionalidad;
                $user->FechaNacimiento  = $FechaNacimiento;
                $user->Domicilio  		= $Domicilio;
                $user->Licencia  		= $Licencia;
                $user->save();
            }
                
            return view('Posts/MultaVehicular/PostsAgregarMulta')->with('Rut', $Rut)->with('TipoNotificacion', $TipoNotificacion);

            // return redirect()->route('MultaVehicular', ['Rut' => $Rut]); 
        }
        else{

            $SinD_Rut='0';

            return view('Posts/MultaVehicular/PostsAgregarMulta')->with('Rut', $SinD_Rut)->with('TipoNotificacion', $TipoNotificacion);

            // return redirect()->route('MultaVehicular', ['Rut' => $SinD_Rut]);


        }


    }
}
