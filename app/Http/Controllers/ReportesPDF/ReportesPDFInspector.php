<?php 

namespace App\Http\Controllers\ReportesPDF; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class ReportesPDFInspector extends Controller
{
	public function index(Request $request)  
    {
		 
	   	$FechaDE = $request->input('FechaDE');
	   	$FechaHasta = $request->input('FechaHasta');
		$idTipoInfraccion = $request->input('idTipoInfraccion');
  		$id_inspector = Auth::user()->id_inspector; 

		$pdf = \PDF::loadView('PDF/ReportePDFInsp', compact('FechaDE','FechaHasta','idTipoInfraccion','id_inspector'));

		return $pdf->stream('ReportePDF.pdf');
    }
} 
