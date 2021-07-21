<?php

namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\InspectorModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class VolverIndexController extends Controller
{
    public function index(Request $request)
    { 
    	
        if(Auth::guard('web')->check()){ 
    
            $Id_Inspector  = Auth::user()->id_inspector;
            $RUN = Auth::user()->Rut; 

            $idLogin=InspectorModel::Select('id_inspector','Activo','Rut','password')->whereRut($RUN)->first();


            $Date=date("Y-m-d");

            $Anio=date("Y");

            $Anio = substr($Anio, -2);

            $Multas =  DB::table('Multas')->select('Fecha')->where('Fecha', '=', $Date)->where('Id_Inspector', '=', $Id_Inspector )->get()->count();

            $PendientesFirma =  DB::table('Multas')->select('Firma')->where('Firma', '=', '0')->where('Id_Inspector', '=', $Id_Inspector )->get()->count();

            $Anio =  DB::table('Multas')->select('Anio')->where('Anio', '=', $Anio)->where('Id_Inspector', '=', $Id_Inspector )->get()->count();

            return view('Sistema/Principal')->with('Multas', $Multas)->with('PendientesFirma', $PendientesFirma)->with('Anio', $Anio);
        }
          
    }
}
