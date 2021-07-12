<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   

class MultasPendientesInsp extends Controller
{
  	public function index()  
    {
		 $posts =  DB::table('Multas') 
          ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
          ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
          ->select('Id_Multas','NumeroParte','Anio','Id_Juzgado','PlacaPatente','Marca','Modelo','Fecha','Nombres','Apellidos')
          ->where('EstadoMulta', '=', '0')
          ->get();

  



        return datatables()->of($posts)
        ->addColumn('ID', function ($posts){     
                return  $posts->Id_Juzgado.$posts->Id_Multas.$posts->Anio;     
        })->addColumn('Detalles', function ($posts){
return  '<button class="btn btn-primary" wire:click="M_Detalles('.$posts->Id_Multas.')">detalles</button>

                    
                  
                          ';
                        
                        
                    })->rawColumns(['ID','Detalles'])
                    ->toJson();




    }
}
