<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ResetearContraseniaController extends Controller
{
    public function index(Request $request)
    {

    	$id = $request->input('id');
    	$token = $request->input('token'); 
        $CorreoActivo = 2; 

    	if (isset($id) AND isset($token)) {  
  
				$Datos=DB::table('Inspectores')->Select('id_inspector','Nombres','Apellidos','CorreoActivo','Token')->where('id_inspector',$id)->first();
    	 
    			if ($Datos->Token==$token AND $Datos->CorreoActivo==$CorreoActivo){
    				return view('Email/TokenValido')->with('Datos', $Datos);
    			}	 
    			else{
					return view('Email/ErrorValidarToken')->with('Datos', $Datos);
    			} 
		}
		else{
			return view('Email/ErrorTokenEditado');
		}
    }
}
