<?php

namespace App\Http\Controllers\Registro; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\InspectorModel;
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
        ];

        $messages = [
            'Rut.required' =>'El campo Rut es obligatorio.',
            'Nombres.required' =>'El campo Nombres es obligatorio.',
            'Apellidos.required' =>'El campo Apellidos es obligatorio.',
            'Contrasenia.required' =>'El campo Contraseña es obligatorio.',
            'Confirmar_Contrasenia.required' =>'El campo Confirmar Contraseña es obligatorio.',
            'Email.required' =>'El campo Email es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);  

        $Rut = $request->input('Rut');
        $Nombres = $request->input('Nombres');
        $Apellidos = $request->input('Apellidos');
        $Contrasenia = $request->input('Contrasenia');
        $Confirmar_Contrasenia = $request->input('Confirmar_Contrasenia');
        $Email = $request->input('Email');
        $Activo = 0;
     
        $Funcionario=InspectorModel::select('Rut','Nombres')->whereRut($Rut)->first();
        
        if((isset($Funcionario->Rut)) AND (!isset($Funcionario->Nombres))) 
        {
            $ExisteEmail=DB::table('Inspectores')->whereEmail($Email)->exists();
            if ($ExisteEmail==0) 
            {
                $id=InspectorModel::Select('id_inspector','Activo')->whereRut($Rut)->first();

                if ($id->Activo==1) {
                         
                    $user = InspectorModel::find($id->id_inspector);
                    $user->Nombres = $Nombres;
                    $user->Apellidos = $Email;
                    $user->Email = $Email;
                    $user->password = Hash::make($Contrasenia);
                    $user->save();

                    $resultado='Registro Realizado Correctamente.';
                }
                else
                {
                    $resultado='Error, Usuario con cuenta desactiva, registro denegado.';
                }
            }
            else
            {
                $resultado='Error, Email registrado anteriormenete, registro denegado.';
            }
        }
        elseif((isset($Funcionario->Rut)) AND (isset($Funcionario->Nombres)))
        {
            $resultado='Error, Usuario registrado anteriormente.';
        }
        else
        {
            $resultado='Error, Usuario sin autorización, registro denegado.';
        }

        return view('Registro/RespuestaRegstro')->with('resultado', $resultado);

    }
}
