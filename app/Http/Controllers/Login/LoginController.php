<?php

namespace App\Http\Controllers\Login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InspectorModel;
use App\Models\FuncionarioModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    { 

    	$rules = [
            'RUN' => 'required', 
            'password' => 'required|min:6',
        ];

        $messages = [
            'RUN.required' =>'El campo Rut es obligatorio.',
            'password.required' =>'El campo Contraseña es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);

        $RUN = $request->input('RUN'); 
        $password = $request->input('password');   
        $Activo0=0;

        $Count_InspectorModel=InspectorModel::select("Rut")->where("Rut",$RUN)->get()->count();

        $Count_FuncionarioModel=FuncionarioModel::select("Rut")->where("Rut",$RUN)->get()->count();

        if ($Count_InspectorModel=='1') 
        {
 
                $idLogin=InspectorModel::Select('id_inspector','Activo','Rut','password')->whereRut($RUN)->first();

                if (!empty($idLogin->Rut) AND !empty($idLogin->Activo==1))
                    { 

                        if(Auth::attempt(['Rut' => $RUN, 'password' => $password], true))
                            { 

                                       
                                $id_inspectorDireccion = Auth::user()->Id_Direccion_T;
                                $NombreDireccion =  DB::table('Direccion')->select('Nombre')->where('id_Direccion', '=', $id_inspectorDireccion)->first();
                
                                session(['NombreDireccion' => $NombreDireccion->Nombre]);



                                
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
                            else
                            {
                               return back()
                                    ->withErrors(['Contraseña Incorrecta'])
                                    ->withInput(request(['RUN']));
                            }
                    }
                elseif(!empty($idLogin->Rut) AND !empty($idLogin->Activo==0))
                    {
                        return back()
                            ->withErrors(['Usuario Desactivado'])
                            ->withInput(request(['RUN']));
                    }
                elseif(!empty($idLogin->Rut) AND !empty($idLogin->Activo==2))
                    {
                        return back()
                            ->withErrors(['Sistema en mantenimiento, ingreso bloqueado.'])
                            ->withInput(request(['RUN']));
                    }
                else
                    {
                        return back()
                            ->withErrors(['Error'])
                            ->withInput(request(['RUN']));
                    }

        }
        elseif($Count_FuncionarioModel=='1')
        {  

                $idLogin=FuncionarioModel::Select('id_Funcionario','Activo','Rut','password')->whereRut($RUN)->first();

                if (!empty($idLogin->Rut) AND !empty($idLogin->Activo==1))
                    { 

                        if(Auth::guard('Funcionario')->attempt(['Rut' => $RUN, 'password' => $password], true))
                            { 
                                return view('Posts/MultaVehicular/PostsJuzIngresoMulta');

                            } 
                            else 
                            {
                               return back()
                                    ->withErrors(['Contraseña Incorrecta'])
                                    ->withInput(request(['RUN']));
                            }
                    }
                elseif(!empty($idLogin->Rut) AND !empty($idLogin->Activo==0))
                    {
                        return back()
                            ->withErrors(['Usuario Desactivado'])
                            ->withInput(request(['RUN']));
                    }
                elseif(!empty($idLogin->Rut) AND !empty($idLogin->Activo==2))
                    {
                        return back()
                            ->withErrors(['Sistema en mantenimiento, ingreso bloqueado.'])
                            ->withInput(request(['RUN']));
                    }
                else
                    {
                        return back()
                            ->withErrors(['Error'])
                            ->withInput(request(['RUN']));
                    }
        }
        else{
            return back()
            ->withErrors(['Usuario No Registrado'])
            ->withInput(request(['RUN']));
           
        }


    }
}
