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
                                return view('Sistema/Principal');

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
                                return view('Sistema/Principal');

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
                else
                    {
                        return back()
                            ->withErrors(['Error'])
                            ->withInput(request(['RUN']));
                    }





        }
        else{

            $resultado='Usuario No Registrado';
        }


       

    }
}
