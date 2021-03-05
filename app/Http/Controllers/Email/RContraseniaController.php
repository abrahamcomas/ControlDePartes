<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\RecuperarPassword;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\InspectorModel;
 
class RContraseniaController extends Controller
{
    public function index(Request $request)
    {
 
        $rules = [
            'Email' => 'required',
        ]; 
 
        $messages = [ 
            'Email.required' =>'El campo Email es obligatorio.',
        ]; 

        $this->validate($request, $rules, $messages);

        $Email = $request->input('Email');

		$DatosFuncionario=DB::table('Inspectores')->where('Email', $Email)->exists(); 

		if ($DatosFuncionario==1) 
			{
				$datos=DB::table('Inspectores')->Select('id_inspector','Nombres','Apellidos')->whereEmail($Email)->first();

				$token1=Str::random(120); 

				$user = InspectorModel::find($datos->id_inspector);
				$user->CorreoActivo = 2;  
	            $user->Token = $token1;
	            $user->save();

				$resultado='Funcionario/a '.$datos->Nombres.' '.$datos->Apellidos.', correo enviado correctamente';
				
				$token= 'http://controldeparte.test/ResetearContrasenia?id='.$datos->id_inspector.'&token='.$token1;

				Mail::to($Email)->send(new RecuperarPassword($datos,$token));
 
			}
		else
			{

 				$resultado='Error, Email no existe en los registros';
			}

        return view('Registro/RespuestaRegstro')->with('resultado', $resultado);
	}
}
 

