<div> 
	<div class="row"> 
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
		<div class="card bg-light mb-3">
			<div class="card-body">
			@include('messages') 
			</div>
		</div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
	</div>
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="col">
                <div class="card bg-light mb-3" >
                    <div class="card-header">
						<center>     
                        <h5><strong>TIPO NOTIFICACIÓN</strong></h5>
						</center> 
                    </div>   
                    <div class="card-body">
						<div class="form-group">
							<div class="form-label-group"> 
                                <button type="button" class="btn" wire:click="ValorTipoNotificacion('1')">
									<a>POR ESCRITO</a>
								</button>
                                <hr>
                                <button type="button" class="btn" wire:click="ValorTipoNotificacion('2')">
									<a>EMPADRONADO</a>
								</button>
                                <hr> 
                                <button type="button" class="btn" wire:click="ValorTipoNotificacion('3')">
									<a>PERSONALMENTE</a>
								</button>
							</div>   
						</div>
					</div>
					@if($TipoNotificacion==1 || $TipoNotificacion==2) 
					<div class="card-footer text-muted">
						<div id="DivRut"> 
							<div class="form-group">
								<form method="POST" action="{{ route('IngresoCiudadano') }}">
									@csrf  
									<input type="hidden" name="TipoNotificacion" value="{{ $TipoNotificacion }}">	
									<div class="btn-group" style=" width:100%;">	                   
										<button type="submit" class="btn btn-info active" >CONTINUAR</button>
									</div>	
								</form>
							</div>	
						</div> 
					</div>
					@endif 	
				</div>
			</div>	
		</div>	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>				
	</div>	

	<div wire:loading.delay wire:target="TipoNotificacion">
		<center>
			<h5><strong>Espere Por Favor...</strong></h5>
			<img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
		</center>
	</div>
	@if($TipoNotificacion==3) 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			<div class="col">
				<div class="card bg-light mb-3" >
					<div class="card-body">
						<div id="DivRut">
							<div class="form-group">
								<center><label for="Rut">RUT</label></center> 
								<div class="form-label-group"> 
									<input type="text" class="form-control" wire:model.debounce.1000ms="Rut" oninput="checkRut(this)" placeholder="Ingrese Rut" autocomplete="off">
								</div>
							</div>	
						</div> 
					</div>
				</div>		
			</div>	
		</div>	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>				
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

	@if($Numero>0 AND $TipoNotificacion==3) 
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
				<div class="col">
					<div class="card bg-light mb-3" >
						<div class="card-body">
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
									<input type="hidden" name="Licencia" value="{{ $post->Licencia }}">
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
									<div class="form-group">
										<center><label for="Licencia">LICENCIA CLASE</label></center>
										<div class="form-label-group"> 
											<input class="form-control" type="text" value="{{ $post->Licencia }}" disabled style="background-color:#D3D3D3;">
										</div> 
									</div>	
									                   
								@endforeach
								<div class="btn-group" style=" width:100%;">	
									<button type="submit" class="btn btn-info active" >CONTINUAR</button>
								</div>	
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>				
		</div>
	@endif
	@if($Numero==0 AND $TipoNotificacion==3)
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
				<div class="col">
					<div class="card bg-light mb-3" >
						<div class="card-body"> 
							<form method="POST" action="{{ route('IngresoCiudadano') }}">
								@csrf 
								<input type="hidden" name="TipoNotificacion" value="{{ $TipoNotificacion }}">
								<input type="hidden" name="Rut" value="{{ $Rut }}"> 
								<div class="form-group">
									<center><label for="Nombres">NOMBRES</label></center>
									<div class="form-label-group"> 
										<input type="text" class="form-control" name="Nombres" placeholder="Nombres" autocomplete="off" required>
									</div>
								</div>		
								<div class="form-group">
									<center><label for="Apellidos">APELLIDOS</label></center>
									<div class="form-label-group"> 
										<input type="text" class="form-control" name="Apellidos" placeholder="Apellidos" autocomplete="off" required>
									</div>
								</div>		
								<div class="form-group">
									<center><label for="Profesion">PROFESION</label></center>
									<div class="form-label-group"> 
										<input type="text" class="form-control" name="Profesion" placeholder="Profesión" autocomplete="off" required>
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
										<input type="date" class="form-control" name="FechaNacimiento" required>
									</div>
								</div>
								<div class="form-group">
									<center><label for="Domicilio">DOMICILIO</label></center>
									<div class="form-label-group"> 
										<input type="text" class="form-control" name="Domicilio" placeholder="Domicilio" autocomplete="off" required>
									</div>
								</div>
								<div class="form-group">
									<center><label for="Licencia">LICENCIA CLASE</label></center>
									<div class="form-label-group">  
										<select name="Licencia" class="form-control"  required>
											<option value="" selected>---SELECCIONAR---</option>
											<optgroup label="Sin Licencia">
												<option>No Posee</option>
											</optgroup>
											<optgroup label="Licencias profesionales">
												<option>Clase A1</option>
												<option>Clase A2</option>
												<option>Clase A3</option>
												<option>Clase A4</option>
												<option>Clase A5</option>
											</optgroup>
											<optgroup label="Licencias no profesionales">
												<option>Clase B</option>
												<option>Clase C</option>
											</optgroup>
											<optgroup label="Licencias especiales">
												<option>Clase D</option>
												<option>Clase E</option>
												<option>Clase F</option>
											</optgroup>
										</select> 
									</div>  
								</div>				
								<div class="btn-group" style=" width:100%;">	
									<button type="submit" class="btn btn-info active" >CONTINUAR</button>
								</div>	
							</form>		       
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>				
		</div>
		@endif
	</div>