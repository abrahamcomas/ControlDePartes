<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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


class EscuchaFirma implements ShouldQueue
{ 
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    } 

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        
        $Id_Multas  = $event->Firma_ID;
        $RUNInspector = '17486231-1';
      
        $RutFirma = substr($RUNInspector, 0, -2); 
 
        $checksum = session('checksum');
        $Ruta        = 'PDF/'.$checksum.'.'.'pdf'; 
        $Ingreso=DB::table('Document')->Select('Ruta')->whereRuta($Ruta)->get();
        $existe=count($Ingreso);
        if( $existe==1){
            return view('Sistema/Principal');
        }
        
    
            $hoy = date("Y-m-d H:i:s");   
            $NuevaFecha = strtotime ( '+4 minute' , strtotime ($hoy) ) ; 
            $NuevaFecha = date ( 'Y-m-d H:i:s' , $NuevaFecha); 
    
                $Purpose='Desatendido';
                
                $header   = [      
                    "alg"=> "HS256",
                    "typ"=> "JWT"
                ];
            
            
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
                               
    
    }
}
