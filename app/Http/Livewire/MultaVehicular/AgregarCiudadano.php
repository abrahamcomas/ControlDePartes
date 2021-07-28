<?php

namespace App\Http\Livewire\MultaVehicular;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;
// use App\Http\Livewire\MultaVehicular\AgregarMulta;

class AgregarCiudadano extends Component
{
	public $TipoNotificacion;
 	public $DatosCiudadano; 
	public $Nacionalidad;
    public $Rut; 
 
    public function render()
    {
    	$this->DatosCiudadano= DB::table('Ciudadanos')
                        ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
                        ->select('Rut','NombresC','Apellidos','Profesion','FechaNacimiento','Domicilio','Licencia','NombreNac')
                        ->where('Ciudadanos.Rut', $this->Rut)->get(); 

        $this->Nacionalidad=DB::table('Nacionalidad')->get();
        
        return view('livewire.multa-vehicular.agregar-ciudadano',[ 
            'Rut'=>$this->Rut,
            'Nacionalidad'=>$this->Nacionalidad,
            'TipoNotificacion'=>$this->TipoNotificacion,
			'DatosCiudadano'=>$this->DatosCiudadano

        ]);
    }
}
