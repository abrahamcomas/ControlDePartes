<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\InspectorModel;

class RestaurarContController extends Controller
{
    public function index(Request $request){
    	$rules = [ 
            'Contrasenia' => 'required|min:6', 
            'Confirmar_Contrasenia' => 'required:Contrasenia|same:Contrasenia|min:6|different:password', 
        ];  

        $messages = [  
            'Contrasenia.required' =>'El campo contraseña es obligatorio.',
            'Confirmar_Contrasenia.required' =>'El campo Confirmar contraseña es obligatorio.'
        ];  
 
        $this->validate($request, $rules, $messages); 

        $Id_Funcionario = $request->input('id_inspector');
        $Contrasenia = $request->input('Contrasenia');
 
        $user = InspectorModel::find($Id_Funcionario);
        $user->CorreoActivo = 1;
        $user->password = Hash::make($Contrasenia);
        $user->save();

        $resultado='Contraseña restaurada correctamente'; 

        return view('Registro/RespuestaRegstro')->with('resultado', $resultado);


    }
}
