<?php

namespace App\Http\Controllers\FirmaDigital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TxtModel;
use Illuminate\Support\Facades\Storage;

class PDFtxtController extends Controller
{
    public function index(Request $request)  
    {
	   	$Id_Multas = $request->input('ID');

        $datos=DB::table('Document')->Select('Ruta')->where('id_Multa_T', '=', $Id_Multas)->get();
	   
        foreach ($datos as $Dato){
            $Ruta = $Dato->Ruta;
        } 
        
        $NombreArchivo = substr($Ruta,1,-4);
    	
		$contents = Storage::disk('PDF')->get($Ruta);
			
		$decoded = base64_decode($contents);
        header('Content-Type: application/pdf');
		$file = $NombreArchivo.'.'.'pdf';
        header('Content-Disposition: inline; filename="'.basename($file).'"');
        echo $decoded;

        /*
		$file = $NombreArchivo.'.'.'pdf';
		$sube = file_put_contents($file, $decoded);

		if (file_exists($file)) {
            header("Content-Description: File Transfer");
            header("Content-Type: application/pdf");
            header('Content-Disposition: inline; filename="'.basename($file).'"');
            header("Expires: 0");
            header("Cache-Control: must-revalidate");
            header("Pragma: public");
            header("Content-Length: " . filesize($file));
            $guardar= readfile($file);
		}*/
    }
}
