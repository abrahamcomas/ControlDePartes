<?php

namespace App\Http\Livewire\Mantenedores;

use Livewire\Component;
use App\Models\TipoInfraccion; 
use Illuminate\Support\Facades\DB; 

class AgregarInfracciones extends Component
{

	public $TipoInfraccion;
	public $InfracionIngr;
	public $Resultado;
 
	protected $rules = ['InfracionIngr' => 'required'];

	protected $messages = ['InfracionIngr.required' =>'El campo "Agregar" es obligatorio.'];

	public function Agregar(){

		$this->validate(); 
		 	$Existe=DB::table('TipoInfraccion')->wheredescripcion($this->InfracionIngr)->exists();
   			if ($Existe==0) 
            	{
					$Infraccion 				= new TipoInfraccion;
			        $Infraccion->descripcion 	= $this->InfracionIngr;
			        $Infraccion->save();

			        $this->Resultado='Ingreso correctamente';
				}
			else{
					$this->Resultado='Error en ingreso';
				}

	}

    public function render()
    {
    	$this->TipoInfraccion=DB::table('TipoInfraccion')->orderBy('descripcion','ASC')->get();

        return view('livewire.mantenedores.agregar-infracciones');
    }
}
