<?php

namespace App\Http\Livewire\Mantenedores;

use Livewire\Component;
use App\Models\ArticulosModel; 
use Illuminate\Support\Facades\DB; 

class AgregarArticulo extends Component
{
	public $TipoArticulos;
	public $ID_Articulo;
	
	public $ArticuloIngr;

	public $Resultado;
 
	protected $rules = ['ArticuloIngr' => 'required'];

	protected $messages = ['ArticuloIngr.required' =>'El campo "Agregar" es obligatorio.'];

	public function Agregar(){

		$this->validate(); 
		 	$Existe=DB::table('Articulo')->where('NombreArt', $this->ArticuloIngr)->exists();
   			if ($Existe==0) 
            	{
					$Infraccion 			= new ArticulosModel;
			        $Infraccion->NombreArt 	= $this->ArticuloIngr;
			        $Infraccion->save();

			        $this->Resultado='Ingreso correctamente';
				}
			else{
					$this->Resultado='Error en ingreso';
				}

				$this->ArticuloIngr='';

	}

    public function render()
    {
    	$this->TipoArticulos=DB::table('Articulo')->orderBy('NombreArt','ASC')->get();

        return view('livewire.mantenedores.agregar-articulo');
    }
}
