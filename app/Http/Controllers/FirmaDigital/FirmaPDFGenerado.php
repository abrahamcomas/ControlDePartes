<?php

namespace App\Http\Controllers\FirmaDigital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\File;
use App\Models\DocumentModel;
use App\Models\IngresoMultaModel;
use Illuminate\Support\Facades\DB;


class FirmaPDFGenerado extends Controller
{
    public function index(Request $request)
    {    
       
        $TipoFirma=Auth::guard('web')->user()->TipoFirma;
        
        if($TipoFirma=='1'){
                
            $rules = [
                'OTP' => 'required',
                'Contrasenia' => 'required',
            ]; 
     
            $messages = [ 
                'OTP.required' =>'El campo OTP es obligatorio.',
                'Contrasenia.required' =>'El campo Contraseña es obligatorio.',  
            ]; 
    
            $this->validate($request, $rules, $messages);
        }
        else{

            $rules = [
                'Contrasenia' => 'required',
            ]; 
     
            $messages = [ 
                'Contrasenia.required' =>'El campo Contraseña es obligatorio.',
            ]; 
    
            $this->validate($request, $rules, $messages);

        }

        $Contrasenia = $request->input('Contrasenia'); 
        $RUNInspector=Auth::guard('web')->user()->Rut;
        $RutFirma = substr($RUNInspector, 0, -2); 
 
        $checksum = session('checksum');
        $Ruta        = 'PDF/'.$checksum.'.'.'pdf'; 
        $Ingreso=DB::table('Document')->Select('Ruta')->whereRuta($Ruta)->get();
        $existe=count($Ingreso);
        if( $existe==1){
            return view('Sistema/Principal');
        }
        
        $Id_Inspector =Auth::guard('web')->user()->id_inspector;

        if(Auth::attempt(['Rut' => $RUNInspector, 'password' => $Contrasenia], true))
        { 
                    
            $Id_Multas = $request->input('Id_Multas');

                $hoy = date("Y-m-d H:i:s");   
                $NuevaFecha = strtotime ( '+4 minute' , strtotime ($hoy) ) ; 
                $NuevaFecha = date ( 'Y-m-d H:i:s' , $NuevaFecha); 

                if($TipoFirma=='1')
                { 
                    $Purpose='Propósito General';    
                    $header= [      
                                    "alg"=> "HS256",
                                    "typ"=> "JWT",
                                    "OTP"=> $OTP
                        ];
                }
                else
                {
                    $Purpose='Desatendido';    
                    $header   = [      
                                    "alg"=> "HS256",
                                    "typ"=> "JWT"
                        ];
                }
                    
                $header2 = base64_Encode(json_encode($header, JSON_UNESCAPED_UNICODE));
                    
                $payload  = [               
                            "entity" => "Ilustre Municipalidad de Curicó",
                            "run" =>  $RutFirma,
                            "expiration" => $NuevaFecha,
                            "purpose" =>  $Purpose
                ];

                $key = "e2c0c1c5115e4d11ad29ff6ff5510c9e";
                        
                $payload2 = base64_Encode(json_encode($payload, JSON_UNESCAPED_UNICODE));
                $payload2 =str_replace("=","",$payload2);
                        
                $unsignedToken = $header2.'.'.$payload2;

                $signature = hash_hmac('sha256',$unsignedToken,$key,true);
                $signature = base64_Encode($signature);
                
                $token = $unsignedToken.'.'.$signature;
                        
                $PDF = \PDF::loadView('PDF/PDFFirmado', compact('Id_Multas'));
                $PDF2 = $PDF->output();
                    
                $codificado = base64_encode($PDF2);
                $Sha256 = hash('sha256', $PDF2);
                    
                $rutaImagen = "Imagenes/escudo.png";
                $contenidoBinario = file_get_contents($rutaImagen);
                $imagenComoBase64 = base64_encode($contenidoBinario);

                $response = Http::post('https://api.firma.cert.digital.gob.cl/firma/v2/files/tickets',[
                    "api_token_key"=> "b6c89848-d732-4cf0-9d5c-771cd7a38e01",
                    "token"=> $token,
                    "files"=> array([
                            "content-type"=> "application/pdf",
                            "content"=>  $codificado,
                            "description"=> "str",
                            "checksum"=> $Sha256,   
                            "layout"=> "<AgileSignerConfig> 
                                            <Application id=\"THIS-CONFIG\"> 
                                                <pdfPassword/> 
                                                <Signature> 
                                                <Visible active=\"true\" layer2=\"true\" label=\"true\" pos=\"1\">
                                                        <llx>0</llx>
                                                        <lly>40</lly>
                                                        <urx>600</urx>
                                                        <ury>10</ury> 
                                                        <page>LAST</page> 
                                                        <image>BASE64</image> 
                                                        <BASE64VALUE>$imagenComoBase64</BASE64VALUE>
                                                    </Visible> 
                                                </Signature> 
                                            </Application> 
                                        </AgileSignerConfig>"
                                        
                    ])
                ]);
                    
                $responseBody = json_decode($response->getBody());
                
                if(empty($responseBody->status))
                    { 
                        $responseFiles = $responseBody->files;
                        foreach($responseFiles as $posicion)
                             { 
                                    $status = $posicion->status;
                             }
                            
                        if($status=='OK')
                        {

                            $responseFiles = $responseBody->files;
                            $responseidSolicitud = $responseBody->idSolicitud;
                            foreach($responseFiles as $posicion)
                            { 
                                $content = $posicion->content;
                                $status = $posicion->status;
                                $checksum_original = $posicion->checksum_original;
                            }
    
                            $file = $checksum_original.'.'.'txt';
                            Storage::disk('PDF')->put($file, $content);
                        
                            $DocumentModel              = new DocumentModel;
                            $DocumentModel->id_Multa_T  = $Id_Multas;
                            $DocumentModel->Ruta        = $checksum_original.'.'.'txt';
                            $DocumentModel->save();
                
                            $IngresoMultaModel = IngresoMultaModel::find($Id_Multas);
                            $IngresoMultaModel->Firma = '1';
                            $IngresoMultaModel->save();
                             
                            session(['checksum' => $checksum_original]);
                            return view('FirmarDocumento/ResultadoFirma', compact('status'));
                        }
                        else 
                        {
                            return view('FirmarDocumento/ResultadoFirma', compact('status'));
                        }

                    }
                    else{
                        $status='ERROR, firma digital no registrada';
                        return view('FirmarDocumento/ResultadoFirma', compact('status'));

                    }
        
          
        }  
        else
        {

            $Detalles=2;
            return back()
            ->withErrors(['Contraseña Incorrecta'])
            ->withInput(request(['RUN']))
            ->withErrors($Detalles); 
        }
       
    }
}
 