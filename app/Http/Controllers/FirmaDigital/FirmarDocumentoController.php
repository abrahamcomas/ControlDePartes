<?php 

namespace App\Http\Controllers\FirmaDigital; 
use App\Models\User; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\File;
class FirmarDocumentoController extends Controller
{ 
    public function index(Request $request)
    {

        $hoy = date("Y-m-d H:i:s");   
        $NuevaFecha = strtotime ( '+4 minute' , strtotime ($hoy) ) ; 
        $NuevaFecha = date ( 'Y-m-d H:i:s' , $NuevaFecha); 

        $header   = [                
            "alg"=> "HS256",
            "typ"=> "JWT"         
        ];

        $payload  = [               
            "entity" => "Ilustre Municipalidad de Curicó",
            "run" => "17486231",
            "expiration" => $NuevaFecha,
            "purpose" => "Desatendido"         
        ];

        $key = "e2c0c1c5115e4d11ad29ff6ff5510c9e";
        $header2 = base64_Encode(json_encode($header, JSON_UNESCAPED_UNICODE));
        
        $payload2 = base64_Encode(json_encode($payload, JSON_UNESCAPED_UNICODE));
        $payload2 =str_replace("=","",$payload2);
        
        $unsignedToken = $header2.'.'.$payload2;

        $signature = hash_hmac('sha256',$unsignedToken,$key,true);
        $signature = base64_Encode($signature);
       
        $token = $unsignedToken.'.'.$signature;
        $OTP = $request->input('OTP');     

        
        
        
        
        
        
        $PDF = $request->file('PDF'); 
        
        //$G = $PDF->store('PDF');

      dd($PDF);

    


       
        $file = $request->file('PDF')->getClientOriginalName();

        $NombreArchivo =basename($request->file('PDF')->getClientOriginalName(),'.'.$request->file('PDF')->getClientOriginalExtension());
        
        $Extencion =$request->file('PDF')->getClientOriginalExtension();
       
   

     

        $contenidoBinario = file_get_contents($PDF);
        
        $codificado = base64_encode($contenidoBinario);

        $Sha256 = hash('sha256', $PDF);

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

         
        $hoy = date("Y-m-d");   
            $decoded = base64_decode($content);
            $file = $checksum_original.'Firmado'.'.'.$NombreArchivo.'.'.$hoy.'.'.$Extencion;
            $sube = file_put_contents($file, $decoded);

            $image = $request->get('image_base64');  // your base64 encoded
            $image = str_replace('data:pdf;base64,', '', $decoded);
            $image = str_replace(' ', '+', $image);
            
          

            Storage::disk('PDF')->put($file, $decoded);
            //Storage::disk('local')->putFile('PDF', $decoded);
           
           
 
           
            if (file_exists($file)) {
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header("Expires: 0");
            header("Cache-Control: must-revalidate");
            header("Pragma: public");
            header("Content-Length: " . filesize($file));
            $guardar= readfile($file);
        
           
            exit;
            }
        


    }
}
 