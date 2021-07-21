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
		@if($MultaIngresada==0)    
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="col">
						<div class="card bg-light mb-3">
							<div class="card-header">
								<center><h5><strong>INGRESAR VEHÍCULO</strong></h5></center> 
							</div>
							<div class="card-body">
								<div id="DivRut"> 
									<div class="form-group">
										<div class="form-label-group"> 
											@if($MostrarPatente==1)  
												<center><h5>PATENTE</h5></center>
			
												<div class="row"> 
												@if($TipoPatente==1)
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
														<input type="text" class="form-control" wire:model.debounce.1000ms="Patente"  oninput="Patente1(this)"placeholder="XX-XXXX" autocomplete="off" maxlength="7">
													</div>
												@elseif($TipoPatente==2) 
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
														<input type="text" class="form-control" wire:model.debounce.1000ms="Patente"  oninput="Patente2(this)"placeholder="XXX-XXX" autocomplete="off" maxlength="7">
													</div>
												@else
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
														<input type="text" class="form-control" wire:model.debounce.1000ms="Patente"  oninput="Patente3(this)" placeholder="XXXX-XX" autocomplete="off" maxlength="7">
													</div>
												@endif
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
														<div class="btn-group" style=" width:100%;">	
															<button type="button" class="btn btn-success active" wire:click="CambiarVehiculo">Cambiar</button>
														</div>	
													</div>
												</div>
											
											
											
											
											
											
											
											
											
											
											
											@else
												<center><h2>PATENTE</h2></center>
												<center><strong><h2> {{ $Patente }} </h2></strong></center>
											@endif
										</div>
									</div>	 
								</div>
							</div>
							<div class="card-footer text-muted">
								@if($MostrarPatente==1)  
									<div class="btn-group" style=" width:100%;">	
										<button type="button" class="btn btn-info active" wire:click="AgregarPatente">Buscar</button>
									</div>	
								@else
									<div class="btn-group" style=" width:100%;">	
										<button type="button" class="btn btn-info active" wire:click="CambiarPatente">Cambiar Patente</button>
									</div>	
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
			</div>
		@endif
			<div wire:loading.delay wire:target="AgregarPatente">
				<center>
					<h5><strong>BUSCANDO DATOS</strong></h5>
					<img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
				</center>
			</div> 
		@if($Mostrar!=0 AND $MultaIngresada==0)
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="col">
						<div class="card bg-light mb-3">
							<div class="card-body">
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
										<center><label for="TipoVehiculo">TIPO VEHÍCULO</label></center>
										<div class="form-group">
											<input wire:model="buscarTV" type="text" class="form-control" id="buscarTV" autocomplete="off" placeholder="BUSCAR TIPO VEHÍCULO">
											@if(!$pickedTV)
												<div class="shadow rounded px-3 pt-3 pb-0">
													@foreach($TipoVehiculos1 as $Tipo)
														<div style="cursor: pointer;">
															<a wire:click="asignarUsuarioTV('{{ $Tipo->Descripcion }}')">
																{{ $Tipo->Descripcion }}
															</a>
														</div>
													@endforeach
												</div>
											@endif
										</div>
									</div>
									<div class="form-group">
										<center><label for="Nacionalidad">MARCA</label></center>
										<div class="form-group">
											<input wire:model="buscarM" type="text" class="form-control" id="buscarM" autocomplete="off" placeholder="BUSCAR TIPO MARCA">
											@if(!$picked1)
												<div class="shadow rounded px-3 pt-3 pb-0">
													@foreach($Marcas as $Marca)
														<div style="cursor: pointer;">
															<a wire:click="asignarUsuarioM('{{ $Marca->Descripcion }}')">
																{{ $Marca->Descripcion }}
															</a>
														</div>
													@endforeach
												</div>
											@endif
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
											<select wire:model="id_Juzgado" class="form-control" > 
												<option selected>---SELECCIONAR---</option>
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
											<strong>A espera de citación por parte de ese JPL.</strong>
										</label>
									</center>
								@endif
									<hr>
										<center><h5>DATOS INFRACCIÓN</h5></center>
									<hr> 
									<div class="form-group">
										<center><label for="TipoInfraccion">TIPO INFRACCIÓN</label></center>
										<div class="form-group">
											<input wire:model="buscar" type="text" class="form-control" id="buscar" autocomplete="off" placeholder="Buscar Tipo Infracción">
											@if(!$picked)
												<div class="shadow rounded px-3 pt-3 pb-0">
													@foreach($Infracciones as $Infraccion)
														<div style="cursor: pointer;">
															<a wire:click="AsignarInfraccion('{{ $Infraccion->descripcion }}')">
																{{ $Infraccion->descripcion }}
															</a>
														</div>
													@endforeach 
												</div>
											@endif  
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
											<input wire:model="Ingreso_Articulo" type="text" class="form-control" autocomplete="off" placeholder="Buscar Artículo">
										</div>
									</div>	 
									<div class="form-group">
										<center><label for="Nacionalidad">DECRETO O LEY</label></center>
										<div class="form-label-group">
											<select class="form-control" wire:model="DecLey"> 
												<option selected>---SELECCIONAR---</option>
												<option selected>Decreto</option> 
												<option selected>Ley</option> 
											</select> 
										</div>
									</div>
									<div class="form-group">
										<center><label for="Nacionalidad">INGRESAR TESTIGO </label></center>
										<div class="form-label-group">
											<select class="form-control" wire:model="Ingreso_Testigo"> 
												<option selected>---SELECCIONAR---</option>
												@foreach ($Testigo as $row)
													<option value="{{ $row->id_inspector }}">{{ $row->Nombres }}</option>
												@endforeach
											</select> 
										</div>
									</div>
									<div class="form-group">
										<center><label for="photo">FOTOS</label></center>
										<div class="form-label-group"> 
											<input type="file" class="form-control" wire:model="photo">
										</div>
									</div>
									<hr>
									<div wire:loading wire:target="photo"><center><strong>Ingresando...</strong></div>
										<div class="btn-group" style=" width:100%;">	
											<button type="button" class="btn btn-info active" wire:click="IngresoMulta">
												Ingresar
											</button>
										</div>
									<div wire:loading wire:target="IngresoMulta"><center><strong>Ingresando...</strong></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
			</div>
		@endif 
		@if($MultaIngresada==1)
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="col">
						<div class="card bg-light mb-3">
							<div class="card-header">
								<center><h1>MULTA INGRESADA CORRECTAMENTE</h1></center>
							</div>
							<div class="card-body">	
								<form method="POST" action="{{ route('MultaPDFSoloID') }}">   
									@csrf            
									<input type="hidden" name="IdMultaIngresada" value=" {{ $IdMultaIngresada }} ">
									<div class="form-group">
										<div class="form-label-group">
											<div class="btn-group" style=" width:100%;">	
												<button type="submit" class="btn btn-success active" formtarget="_blank">Imprimir Multa</button>
											</div>
										</div>
									</div>
								</form> 
							</div>    
						</div>
					</div> 
				</div>           
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
			<div class="row">
		@endif
</div>

 
