<?php

namespace App\Http\Controllers\ReportesPDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteFechaJuzgado extends Controller
{
   	public function index(Request $request)  
    {
		$FechaDE = $request->input('FechaDE');
	   	$FechaHasta = $request->input('FechaHasta');

		$pdf = \PDF::loadView('PDF/ReportePDFJuzgadoFecha', compact('FechaDE','FechaHasta'));

		return $pdf->stream('ReportePDFJuzgadoFecha.pdf');
    }
}
