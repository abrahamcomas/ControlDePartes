<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
		<br> 
		<center>
			<h4><strong>INGRESAR CIUDADANO/A</strong></h4> 
		</center>   
		<hr style="width:100%; border-color: blue;"> 
		<div class="panel-body"> 
			@include('messages')  
			<div class="form-group"> 
			 	<center><label for="TipoNotificacion">TIPO NOTIFICACIÓN</center>
              	<div class="form-label-group"> 
                	<select wire:model="TipoNotificacion" name="TipoNotificacion" class="form-control" value="{{ old('TipoNotificacion') }}">
		       			<option value="1" selected>Por Escrito</option>
		       			<option value="2">Personalmente</option>
					</select>
              	</div> 
           	</div>	 

			<div wire:loading.delay wire:target="TipoNotificacion">
              	<center>
  					<h5><strong>Espere Por Favor...</strong></h5>
          			<img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
              	</center>
		    </div>
					
			@if($TipoNotificacion==2) 
			    <div id="DivRut">
                   	<div class="form-group">
                   		<center><label for="Rut">RUT</label></center>
                      	<div class="form-label-group"> 
                        	<input type="text" class="form-control" wire:model.debounce.1000ms="Rut" oninput="checkRut(this)" placeholder="Ingrese Rut" autocomplete="off">
                      	</div>
                   	</div>	
		        </div> 
		    @else
		        <div id="DivRut"> 
                   	<div class="form-group">
                   		<form method="POST" action="{{ route('IngresoCiudadano') }}">
							@csrf  		                   
			        		<center>
		            			<button type="submit" class="btn btn-info active" >CONTINUAR</button>
		            		</center>
						</form>
                   	</div>	
		        </div> 
			@endif 
					
			<div wire:loading.delay wire:target="Rut">
              	<center>
      				<h5><strong>Buscando Ciudadano/a...</strong></h5>
          			<img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
              	</center>
		    </div>
 
		    @php  
				$Numero=count($DatosCiudadano) 
			@endphp 

			@if($Numero>0 AND $TipoNotificacion==2) 
				<form method="POST" action="{{ route('IngresoCiudadano') }}">
					@csrf   
					@foreach ($DatosCiudadano as $post)
						<input type="hidden" name="TipoNotificacion" value="{{ $TipoNotificacion }}">
						<input type="hidden" name="Rut" value="{{ $post->Rut }}">
						<input type="hidden" name="Nombres" value="{{ $post->NombresC }}">
						<input type="hidden" name="Apellidos" value="{{ $post->Apellidos }}">
						<input type="hidden" name="Profesion" value="{{ $post->Profesion }}">
						<input type="hidden" name="Nacionalidad" value="{{ $post->NombreNac }}">
						<input type="hidden" name="FechaNacimiento" value="{{ $post->FechaNacimiento }}">
						<input type="hidden" name="Domicilio" value="{{ $post->Domicilio }}">
	                   	<div class="form-group">
						 	<center><label for="Nombres">NOMBRES</label></center>
	                      	<div class="form-label-group"> 
	                 			<input type="text" class="form-control"  value="{{ $post->NombresC }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>		
	                   	<div class="form-group">
						 	<center><label for="Apellidos">APELLIDOS</label></center>
	                      	<div class="form-label-group"> 
	                        	<input type="text" class="form-control" value="{{ $post->Apellidos }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>		
	                   	<div class="form-group">
						 	<center><label for="Profesion">PROFESIÓN</label></center>
	                      	<div class="form-label-group"> 
	                        	<input type="text" class="form-control" value="{{ $post->Profesion }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>	
	                   	<div class="form-group">
						 	<center><label for="Nacionalidad">NACIONALIDAD</label></center>
	                      	<div class="form-label-group">
	                        	<input type="text" class="form-control" value="{{ $post->NombreNac }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>	
	                   	<div class="form-group">
						 	<center><label for="FechaNacimiento">FECHA NACIMIENTO</label></center>
	                      	<div class="form-label-group"> 
	                        	<input type="date" class="form-control" value="{{ $post->FechaNacimiento }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>
	                   	<div class="form-group">
						 	<center><label for="Domicilio">DOMICILIO</label></center>
	                      	<div class="form-label-group"> 
	                        	<input class="form-control" type="text" value="{{ $post->Domicilio }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>			                   
	        		@endforeach
	        		<center>
	        			<button type="submit" class="btn btn-info active" >CONTINAUR</button>
            		</center>
				</form>
			@endif

			@if($Numero==0 AND $TipoNotificacion==2)
				<form method="POST" action="{{ route('IngresoCiudadano') }}">
					@csrf 
					<input type="hidden" name="TipoNotificacion" value="{{ $TipoNotificacion }}">
					<input type="hidden" name="Rut" value="{{ $Rut }}"> 
            	   	<div class="form-group">
					 	<center><label for="Nombres">NOMBRES</label></center>
                      	<div class="form-label-group"> 
                        	<input type="text" class="form-control" name="Nombres" placeholder="Nombres">
                      	</div>
                   	</div>		
                   	<div class="form-group">
					 	<center><label for="Apellidos">APELLIDOS</label></center>
                      	<div class="form-label-group"> 
                        	<input type="text" class="form-control" name="Apellidos" placeholder="Apellidos">
                      	</div>
                   	</div>		
                   	<div class="form-group">
					 	<center><label for="Profesion">PROFESION</label></center>
                      	<div class="form-label-group"> 
                        	<input type="text" class="form-control" name="Profesion" placeholder="Profesión">
                      	</div>
                   	</div>	
                   	<div class="form-group">
					 	<center><label for="Nacionalidad">NACIONALIDAD</label></center>
                      	<div class="form-label-group">
                        	<select class="form-control" size="3" name="Nacionalidad" required>
                                @foreach ($Nacionalidad as $row)
                                    <option value="{{ $row->id_Nacionalidad }}">{{ $row->NombreNac }}</option>
                                @endforeach
                          	</select> 
                      	</div>
                   	</div>	
                   	<div class="form-group">
					 	<center><label for="FechaNacimiento">FECHA NACIMIENTO</label></center>
                      	<div class="form-label-group"> 
                        	<input type="date" class="form-control" name="FechaNacimiento">
                      	</div>
                   	</div>
                   	<div class="form-group">
					 	<center><label for="Domicilio">DOMICILIO</label></center>
                      	<div class="form-label-group"> 
                        	<input type="text" class="form-control" name="Domicilio" placeholder="Domicilio">
                      	</div>
                   	</div>	
                   	<center>
            			<button type="submit" class="btn btn-info active" >CONTINUAR</button>
            		</center>
				</form>		       
			@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div>

 
