<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InspectorModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class VolverIndexController extends Controller
{
    public function index(Request $request)
    { 

    	$Id_Funcionario = Auth::user()->id_inspector;
 		$RUN = Auth::user()->Rut; 

        $idLogin=InspectorModel::Select('id_inspector','Activo','Rut','password')->whereRut($RUN)->first();

        return view('Sistema/Principal');

          
    }
}
