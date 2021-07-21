<?php

namespace App\Http\Controllers\Sessiones; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Auth; 

class SessionesController extends Controller
{
    public function index(Request $request)  
    {
	
    
      $Id_Inspector  = Auth::user()->id_inspector;
                                        
      $sessiones =  DB::table('sessions')->where('user_id', '=', $Id_Inspector)->get();
   
      return view('Vinculados/DispositivosVinculados')->with('sessiones', $sessiones);
    }
}
