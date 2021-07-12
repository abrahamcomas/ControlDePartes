<?php
 
namespace App\Http\Controllers\MultaPDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MultaPDF extends Controller
{
    public function index(Request $request)
    { 

    	$Id_Multas = $request->input('Id_Multas');
	   	$TipoNotificacion = $request->input('TipoNotificacion');
	   	$NombresC = $request->input('NombresC');
	   	$ApellidosCiu = $request->input('ApellidosCiu');
	  
	   	$RutCiudadano = $request->input('RutCiudadano');
	   	$Profesion = $request->input('Profesion');
	   	$NombreNac = $request->input('NombreNac');
	   	$Domicilio = $request->input('Domicilio');
	   	$PlacaPatente = $request->input('PlacaPatente');
	   	$TipoVehiculo = $request->input('TipoVehiculo');
	   	$Marca = $request->input('Marca');
	   	$Modelo = $request->input('Modelo');
	   	$Color = $request->input('Color');

	   	$NombreJuzgado = $request->input('NombreJuzgado');
	   	$FechaCitacion = $request->input('FechaCitacion');
	   	$descripcion = $request->input('descripcion');
	   	$Lugar = $request->input('Lugar');
	   	$Hora = $request->input('Hora');
	   	$id_Articulo = $request->input('id_Articulo');
	   	$Fecha = $request->input('Fecha');

		$Nombres = $request->input('Nombres');
	   	$ApellidosInsp = $request->input('ApellidosInsp');

	   	$Id_Juzgad = $request->input('Id_Juzgad');
		$NumeroParte = $request->input('NumeroParte');
	   	$Anio = $request->input('Anio');

		$NombresT = $request->input('NombresT');
	   	$ApellidosT = $request->input('ApellidosT');

		$pdf = \PDF::loadView('PDF/MultaPDF', compact('Id_Multas','TipoNotificacion','NombresC','ApellidosCiu','RutCiudadano','Profesion','NombreNac','Domicilio','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','Lugar','Hora','id_Articulo','Fecha','Nombres','ApellidosInsp','Id_Juzgad','NumeroParte','Anio','NombresT','ApellidosT'));

		return $pdf->stream('ReportePDFJuzgadoFecha.pdf');

    }
} 
