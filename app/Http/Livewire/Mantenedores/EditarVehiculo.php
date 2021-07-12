<?php

namespace App\Http\Livewire\Mantenedores;

use Livewire\Component;
use App\Models\IngCiudadanoModel; 
use Illuminate\Support\Facades\DB; 

class EditarVehiculo extends Component
{

	public $Patente; 
	public $RutBuscado;
	

	public $ID_Ciudadano;
	public $NombresC;
	public $Apellidos;
	public $Profesion;
	public $ID_Nacionalidad;
	public $FechaNacimiento;
	public $Domicilio;
	
	public $NombreNac;
 
 	public $Nacionalidad;  
	public $resutado; 
	public $VariableVista='3'; 

	protected $rules = ['Patente' => 'required'];

	protected $messages = ['Patente.required' =>'El campo Patente es obligatorio.'];

	protected $Update = [	'NombresC' => 'required',
							'Apellidos' => 'required',
							'Profesion' => 'required',
							'ID_Nacionalidad' => 'required',
							'FechaNacimiento'=>'required',
							'Domicilio'=>'required'];
	
	protected $UpdateMessages = ['NombresC.required' =>'El campo "Nombres" es obligatorio.',
							'Apellidos.required' =>'El campo "Apellidos" es obligatorio.',
							'Profesion.required' =>'El campo "Profesion" es obligatorio.',
							'ID_Nacionalidad.required' =>'El campo "Nacionalidad" es obligatorio.',
							'FechaNacimiento.required' =>'El campo "Fecha Nacimiento" es obligatorio.',
							'Domicilio.required' =>'El campo "Domicilio" es obligatorio.'];

	public function Cancelar()  
    { 
		$this->VariableVista='3'; 
		$this->Patente='';
    }

	public function update()   
    { 
        	$this->validate($this->Update,$this->UpdateMessages); 

        	$user =IngCiudadanoModel::find($this->ID_Ciudadano);
			$user->NombresC			=$this->NombresC;
			$user->Apellidos		=$this->Apellidos;
			$user->Profesion		=$this->Profesion;
			$user->ID_Nacionalidad 	=$this->ID_Nacionalidad;
			$user->FechaNacimiento	=$this->FechaNacimiento;
			$user->Domicilio		=$this->Domicilio;
            $user->save();

            $this->VariableVista='4';
			$this->Rut='';
    }
 
    public function Buscar()   
    { 

    	$this->validate();  

        $Datos=DB::table('Vehiculos')->Select('id_Ciudadano')->whereRut($this->Rut)->get();

		foreach ($Datos as $Dato){
            $this->ID_Ciudadano = $Dato->id_Ciudadano ;
        } 
        


        if ($ID!='[]'){
        	
        	foreach ($ID as $user){
            $this->ID_Ciudadano = $user->id_Ciudadano ;
        	} 
              
	        $user =IngCiudadanoModel::find($this->ID_Ciudadano);
	        $this->RutBuscado		=$user->Rut;
			$this->NombresC			=$user->NombresC; 
			$this->Apellidos		=$user->Apellidos;
			$this->Profesion		=$user->Profesion;
			$this->NombreNac		=$user->Nacionalidad->NombreNac;
			$this->FechaNacimiento	=$user->FechaNacimiento;
			$this->Domicilio		=$user->Domicilio;

			$this->VariableVista='1';
        }
        else{

        	$this->resutado='No Encontrado';
        	$this->VariableVista='0';
        }
        
 

    }
    public function render()
    {
    	$this->Nacionalidad=DB::table('Nacionalidad')->get();

        return view('livewire.mantenedores.editar-vehiculo');
    }
}
