<?php

namespace App\Http\Controllers\ReportesPDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportePDFJuzgado extends Controller
{
   	public function index(Request $request)  
    {
		 
	   	$Id_Multas = $request->input('Id_Multas');
	  
		$pdf = \PDF::loadView('PDF/ReportePDFJuzgado', compact('Id_Multas'));

		return $pdf->stream('ReportePDFJuzgado.pdf');
    }
}
 