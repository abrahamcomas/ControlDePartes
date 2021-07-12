<?php

namespace App\Http\Controllers\Registro; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\InspectorModel;
use App\Models\FuncionarioModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function index(Request $request)
    {
        $rules = [ 
            'Rut' => 'required', 
            'Nombres' => 'required', 
            'Apellidos' => 'required', 
            'Contrasenia' => 'required|min:6',
            'Confirmar_Contrasenia' => 'required:Contrasenia|same:Contrasenia|min:6|different:password',
            'Email' => 'required',
            'Firma' => 'required',
        ]; 

        $messages = [
            'Rut.required' =>'El campo Rut es obligatorio.',
            'Nombres.required' =>'El campo Nombres es obligatorio.',
            'Apellidos.required' =>'El campo Apellidos es obligatorio.',
            'Contrasenia.required' =>'El campo Contraseña es obligatorio.',
            'Confirmar_Contrasenia.required' =>'El campo Confirmar Contraseña es obligatorio.',
            'Email.required' =>'El campo Email es obligatorio.',
            'Firma.required' =>'El campo Firma es obligatorio.'
        ]; 

        $this->validate($request, $rules, $messages);  

        $Rut = $request->input('Rut');
        $Nombres = $request->input('Nombres');
        $Apellidos = $request->input('Apellidos');
        $Contrasenia = $request->input('Contrasenia');
        $Confirmar_Contrasenia = $request->input('Confirmar_Contrasenia');
        $Email = $request->input('Email');
        $Firma = $request->input('Firma');
        $Activo = 0;

        $Count_InspectorModel=InspectorModel::select("Rut")->where("Rut",$Rut)->get()->count();

        $Count_FuncionarioModel=FuncionarioModel::select("Rut")->where("Rut",$Rut)->get()->count();

        if ($Count_InspectorModel=='1') 
        {
            
                $C_InspectorModel=InspectorModel::select('Rut','Nombres')->whereRut($Rut)->get();

                foreach ($C_InspectorModel as $Dato){
                    $C_Rut = $Dato->Rut ;
                    $C_Nombres = $Dato->Nombres ;
                }
            
                if((isset($C_Rut)) AND (!isset($C_Nombres))) 
                {
                    $ExisteEmail=DB::table('Inspectores')->whereEmail($Email)->exists();
                    if ($ExisteEmail==0) 
                    {
                        $id=InspectorModel::Select('id_inspector','Activo')->whereRut($Rut)->first();

                        if ($id->Activo==1) {
                            
                            $user = InspectorModel::find($id->id_inspector);
                            $user->TipoFirma = $Firma;
                            $user->Nombres = $Nombres;
                            $user->Apellidos = $Apellidos;
                            $user->Email = $Email;
                            $user->password = Hash::make($Contrasenia);
                            $user->save();

                            $resultado='Registro Realizado Correctamente.';
                        }
                        else
                        {
                            $resultado='Error, Usuario con cuenta desactivada, registro denegado.';
                        }
                    }
                    else
                    {
                        $resultado='Error, Email registrado anteriormenete, registro denegado.';
                    }
                }
                elseif((isset($C_Rut)) AND (isset($C_Nombres)))
                {
                    $resultado='Error, Usuario registrado anteriormente.';
                }
                else
                {
                    $resultado='Error.';
                }

        }
        elseif($Count_FuncionarioModel=='1')
        {       

                $C_FuncionarioModel=FuncionarioModel::select('Rut','Nombres')->whereRut($Rut)->get();

                foreach ($C_FuncionarioModel as $Dato){
                    $C_Rut = $Dato->Rut ;
                    $C_Nombres = $Dato->Nombres ;
                }

                if((isset($C_Rut)) AND (!isset($C_Nombres))) 
                {
                    $ExisteEmail=DB::table('Funcionario')->whereEmail($Email)->exists();
                    if ($ExisteEmail==0) 
                    {
                        $id=FuncionarioModel::Select('id_Funcionario','Activo')->whereRut($Rut)->first();

                        if ($id->Activo==1) {
                                 
                            $user = FuncionarioModel::find($id->id_Funcionario);
                            $user->Nombres = $Nombres;
                            $user->Apellidos = $Apellidos;
                            $user->Email = $Email;
                            $user->password = Hash::make($Contrasenia);
                            $user->save();

                            $resultado='Registro Realizado Correctamente.';
                        }
                        else
                        {
                            $resultado='Error, Usuario con cuenta desactivada, registro denegado.';
                        }
                    }
                    else
                    {
                        $resultado='Error, Email registrado anteriormenete, registro denegado.';
                    }
                }
                elseif((isset($C_Rut)) AND (isset($C_Nombres)))
                {
                    $resultado='Error, Usuario registrado anteriormente.';
                }
                else
                {
                    $resultado='Error.';
                }

        }
        else{

            $resultado='Error, Usuario sin autorización, registro denegado.';
        }

        return view('Registro/RespuestaRegstro')->with('resultado', $resultado);

    }
}
