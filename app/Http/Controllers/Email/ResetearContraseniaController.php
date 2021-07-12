<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ResetearContraseniaController extends Controller
{ 
    public function index(Request $request)
    { 

    	$Tl = $request->input('Tl');
        $Rut = $request->input('Rut');
    	$token = $request->input('token'); 
        $CorreoActivo = 2; 
        
        if (isset($Tl) AND isset($token)) {  
 
                if ($Tl==1) 
                    {

                        $Datos=DB::table('Inspectores')->Select('id_inspector','Nombres','Apellidos','CorreoActivo','Token')->whereRut($Rut)->first();
         
                        if ($Datos->Token==$token AND $Datos->CorreoActivo==$CorreoActivo){
                            return view('Email/TokenValido')->with('Datos', $Datos);
                        }    
                        else{
                            return view('Email/ErrorValidarToken')->with('Datos', $Datos);
                        } 
         
                    }
                elseif ($Tl==2)  
                    {
                
                        $Datos=DB::table('Funcionario')->Select('id_Funcionario','Nombres','Apellidos','CorreoActivo','Token')->whereRut($Rut)->first();
         
                        if ($Datos->Token==$token AND $Datos->CorreoActivo==$CorreoActivo){
                            return view('Email/TokenValido2')->with('Datos', $Datos);
                        }    
                        else{
                            return view('Email/ErrorValidarToken')->with('Datos', $Datos);
                        } 
         
                    }

        }
        else{
            return view('Email/ErrorTokenEditado');
        }
















   
    }
}
