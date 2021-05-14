<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
		<br>
    @if($MultaIngresada==0)    
  		<center>
  			<h4><strong>  
  				{{ $NombreJuzgado }}<br>
  				MULTA N°{{ $id_Juzgado }}{{ $NumeroParte }}{{ date('y') }}
  				</strong>
  			</h4> 
  		</center>    
  		<hr style="width:100%; border-color: blue;"> 
		<div class="panel-body"> 
			@include('messages') 
    			<center><h5>INGRESAR VEHÍCULO/A</h5></center>
    			<hr> 	
    			<div id="DivRut">
            <div class="form-group">
             	<center><label for="Patente">PATENTE</label></center>
              <div class="form-label-group"> 
                <input type="text" class="form-control" wire:model.debounce.1000ms="Patente"  placeholder="Ingrese Patente" autocomplete="off">
              </div>
            </div>	 
          </div> 
    			<center>
    				<button type="button" class="btn btn-info active" wire:click="AgregarPatente">Buscar</button>
    			</center>
    	   	<hr> 
    			<div wire:loading.delay wire:target="AgregarPatente">
          	<center>
    				<h5><strong>BUSCANDO DATOS</strong></h5>
        			<img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
          	</center>
    	    </div> 
      @endif
		  @if($Mostrar!=0 AND $MultaIngresada==0)
    			@if($Numero!=0)  
           	<div class="form-group">
    				 	<center><label for="TipoVehiculo">TIPO VEHÍCULO</label></center>
            	<div class="form-label-group"> 
           			<input type="text" class="form-control"  wire:model="TipoVehiculo" disabled style="background-color:#D3D3D3;" required>
            	</div>
           	</div>		
           	<div class="form-group">
    				 	<center><label for="Apellidos">MARCA</label></center>
            	<div class="form-label-group"> 
              	<input type="text" class="form-control" wire:model="Marca" disabled style="background-color:#D3D3D3;">
            	</div>
           	</div>		
           	<div class="form-group">
    				 	<center><label for="Profesion">MODELO</label></center>
            	<div class="form-label-group"> 
              	<input type="text" class="form-control" wire:model="Modelo" disabled style="background-color:#D3D3D3;">
            	</div>
           	</div>	
           	<div class="form-group">
    				 	<center><label for="Color">COLOR</label></center>
            	<div class="form-label-group">
              	<input type="text" class="form-control" wire:model="Color" disabled style="background-color:#D3D3D3;">
            	</div>
           	</div>	                  
          @else 
       	    <div class="form-group">
    				 	<center><label for="TipoVehiculo">TIPO VEHÍCULO </label></center>
            	<div class="form-group">
                <select wire:model="TipoVehiculo" class="form-control" size="5">
                <option selected><strong>Seleccionar</strong></option>
          		    @foreach ($TipoVehiculos as $row)
          			    <option value="{{ $row->Codigo }}">{{ $row->Descripcion }}</option>
          		    @endforeach
        		    </select> 
              </div>
           	</div>		
           	<hr>       
           	<div class="form-group">
    				 	<center><label for="MARCA">MARCA</label></center>
             	<div class="form-group">
     						<select wire:model="Marca" class="form-control"> 
                  @foreach ($Marcas as $row)
                    <option value="{{ $row->Descripcion  }}">{{ $row->Descripcion }}</option>
                  @endforeach
                </select> 
              </div>
           	</div>	
           	<div class="form-group">
    				 	<center><label for="Modelo">MODELO</label></center>
            	<div class="form-label-group"> 
              	<input wire:model="Modelo" type="text" class="form-control" placeholder="Modelo" required>
            	</div>
           	</div>	  
           	<div class="form-group">
    				 	<center><label for="Color">COLOR</label></center>
            	<div class="form-label-group"> 
              	<input wire:model="Color" type="text" class="form-control" placeholder="Color" required>
            	</div>
           	</div> 
    			@endif 
					<hr>
					<center><h5>DATOS CITACIÓN</h5></center>
					<hr> 
					<div class="form-group">
					 	<center><label for="Nacionalidad">JUZGADO DE TURNO</label></center>
          	<div class="form-label-group">
            	<select wire:model="id_Juzgado" class="form-control" disabled> 
                @foreach ($Juzgado as $row)
                  <option value="{{ $row->id_Juzgado  }}">{{ $row->NombreJuzgado }}</option>
                @endforeach
            	</select> 
         	  </div> 
       	  </div>	
                
          @if($TipoNotificacion!=2)
  					<div class="form-group"> 
					 	 <center><label for="Modelo">FECHA CITACIÓN</label></center>
            	<div class="form-label-group"> 
              	<input type="date" class="form-control" wire:model="FechaCitacion" value="{{ old('FechaCitacion') }}">
            	</div>
           	</div>
          @else 
           <center>
           		<label>
           			<strong>A espera de citación por parte del juzgado.</strong>
           		</label>
           	</center>
          @endif
					<hr>
						<center><h5>DATOS INFRACCIÓN</h5></center>
					<hr> 
					<div class="form-group">
					 	<center><label for="TipoInfraccion">TIPO INFRACCIÓN</label></center>
		  			<div class="form-group">
              <select wire:model="Ingreso_TipoInfraccion" class="form-control" size='5'> 
			      		@foreach ($Infracciones as $row)
		        			<option value="{{ $row->id_Infraccion  }}">{{ $row->descripcion }}</option>
			      		@endforeach
      		    </select>  
            </div>
         	</div>	 
 					<div class="form-group">
					 	<center><label for="Lugar">LUGAR DE INFRACCIÓN</label></center>
          	<div class="form-label-group"> 
            	<input type="text" class="form-control" placeholder="Lugar De Infracción" wire:model="Ingreso_Lugar" value="{{ old('Lugar') }}" required>
          	</div>
         	</div>
					<div class="form-group"> 
					 	<center><label for="Articulo">INFRACCION ARTÍCULO</label></center>
		  			<div class="form-group">
              <select wire:model="Ingreso_Articulo" class="form-control" size='5'> 
			      		@foreach ($InfraccionesArt as $row)
		        			<option value="{{ $row->id_Articulo }}">{{ $row->NombreArt }}</option>
			      		@endforeach
		      		</select> 
            </div>
         	</div>	 
         	<div class="form-group">
					 	<center><label for="Nacionalidad">INGRESAR TESTIGO {{ $Ingreso_Testigo }} </label></center>
          	<div class="form-label-group">
            	<select class="form-control" wire:model="Ingreso_Testigo"> 
            		<option selected>Seleccionar</option>
                  @foreach ($Testigo as $row)
                    <option value="{{ $row->id_inspector }}">{{ $row->Nombres }}</option>
                  @endforeach
            	</select> 
         	  </div>
         	</div>	
         	<div class="form-group">
					 	<center><label for="Modelo">FOTOS</label></center>
          	<div class="form-label-group"> 
            	<input type="file" class="form-control" wire:model="photo">
          	</div>
         	</div>
         	<hr>
          <center>
      			<button type="button" class="btn btn-info active" wire:click="IngresoMulta">
          		Ingresar
        		</button>
        	</center>
        @endif  

        @if($MultaIngresada==1)
          <center><h1>MULTA INGRESADA CORRECTAMENTE</h1></center>
          <br>
          <form method="POST" action="{{ route('MultaPDFSoloID') }}">   
            @csrf            
            <input type="hidden" name="IdMultaIngresada" value=" {{ $IdMultaIngresada }} ">
            <div class="form-group">
              <div class="form-label-group">
                <center>
                  <button type="submit" class="btn btn-success active" formtarget="_blank">Imprimir Multa</button>
                </center> 
              </div>
            </div>
          </form>     
        @endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div>

 
