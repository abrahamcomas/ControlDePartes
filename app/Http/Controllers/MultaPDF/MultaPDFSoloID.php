<?php

namespace App\Http\Controllers\MultaPDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MultaPDFSoloID extends Controller
{
	public function index(Request $request)
    { 
    
    	$IdMultaIngresada = $request->input('IdMultaIngresada');
	   
		$pdf = \PDF::loadView('PDF/MultaPDFSoloID', compact('IdMultaIngresada'));

		return $pdf->stream('PDF.pdf');
	}
}
 