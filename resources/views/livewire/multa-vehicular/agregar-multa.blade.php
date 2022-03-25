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
												<!--<center><h5>PATENTE</h5></center>
												<div class="row"> 
												@if($TipoPatente==1)
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<input type="text" class="form-control" wire:model.debounce.1000ms="Patente"  oninput="Patente1(this)"placeholder="XX-XXXX" autocomplete="off" maxlength="7">
													</div>
												@elseif($TipoPatente==2) 
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<input type="text" class="form-control" wire:model.debounce.1000ms="Patente"  oninput="Patente2(this)"placeholder="XXX-XXX" autocomplete="off" maxlength="7">
													</div>
												@else
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<input type="text" class="form-control" wire:model.debounce.1000ms="Patente"  oninput="Patente3(this)" placeholder="XXXX-XX" autocomplete="off" maxlength="7">
													</div>
												@endif
												</div>
												<hr>
													<center>
														<button type="button" class="btn btn-success active" wire:click="CambiarVehiculo">Cambiar</button>
													</center>-->

                                                    <input type="text" class="form-control" wire:model.debounce.1000ms="Patente"  oninput="Patente(this)"placeholder="Patente" autocomplete="off" maxlength="7">
											@else
												<center><h5>PATENTE</h5></center>
												<center><strong><h5> {{ $Patente }} </h5></strong></center>
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
                                            <button type="button" class="btn" wire:click="Valorid_Juzgado('1')">
                                                <a>PRIMER JUZGADO DE POLICÍA LOCAL  
                                                    @if($id_Juzgado==1)
                                                        <strong>{{ $SeleccionadoJuzgado}}</strong>
                                                    @endif
                                                </a>
                                            </button>
                                            <hr> 
                                            <button type="button" class="btn" wire:click="Valorid_Juzgado('2')">
                                                    <a>SEGUNDO JUZGADO DE POLICÍA LOCAL
                                                    @if($id_Juzgado==2)
                                                        <strong>{{ $SeleccionadoJuzgado}}</strong>
                                                    @endif</a>
                                            </button>
                                            <hr> 
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

								@if($TipoNotificacion==2)
									<div class="form-group"> 
										<center><label for="Modelo">HORA</label></center>
										<div class="form-label-group">  
											<input type="time" class="form-control" wire:model="Hora" value="{{ old('Hora') }}">
										</div>
									</div>
								@endif
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
										<center><label for="Lugar">LUGAR DE INFRACCIÓN (DIRECCIÓN)</label></center>
										<div class="form-label-group"> 
											<input type="text" class="form-control" placeholder="Lugar De Infracción" wire:model="Ingreso_Lugar" value="{{ old('Lugar') }}" required>
										</div>
									</div>
									<div class="form-group">  
										<center><label for="Articulo">INFRACCIÓN ARTÍCULO (OPCIONAL)</label></center>
										<div class="form-group">
											<input wire:model="Ingreso_Articulo" type="text" class="form-control" autocomplete="off" placeholder="Buscar Artículo">
										</div> 
									</div>	 
									<div class="form-group"> 
										<div class="row">  
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
												<center><label for="Nacionalidad">DECRETO O LEY</label></center>
												<div class="form-label-group">
                                                    <button type="button" class="btn" wire:click="ValorDecLey('Decreto')">
                                                        <a>Decreto</a>
                                                    </button>
                                                    <hr> 
                                                    <button type="button" class="btn" wire:click="ValorDecLey('Ley')">
                                                        <a>Ley</a>
                                                    </button>
                                                    <hr> 
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
												<center><label for="Lugar">DETALLES <strong>{{ $DecLey }}</strong></label></center>
												<div class="form-label-group"> 
													<input type="text" class="form-control" placeholder="Detalles" wire:model="DetallesDecLey" required>
												</div>
											</div>
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
										<center><label for="Lugar">OBSERVACIÓN (OPCIONAL)</label></center>
										<div class="form-label-group"> 
                                        <textarea class=" form-control" wire:model="Observacion" maxlength="200"></textarea>
										</div>
									</div> 
									<div class="form-group">
										<center><label for="photo">FOTOS</label></center>
										<div class="form-label-group"> 
											<input type="file" class="form-control" wire:model="photo">
										</div> 
									</div>
									<hr> 
									<div wire:loading wire:target="photo">
										<center> 
											<h6><strong>Subiendo foto, espere por favor...</strong></h6>
										</center>
									</div>
									<div class="btn-group" style=" width:100%;">	
										<button type="button" class="btn btn-info IngresoMulta active" id="IngresoMulta" wire:click="IngresoMulta">
											Ingresar
										</button> 
									</div>
									<div wire:loading wire:target="IngresoMulta">
										<center> 
											<h6><strong>Ingresando multa, espere por favor...</strong></h6>
										</center>
									</div>
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
								<center><h5>MULTA INGRESADA CORRECTAMENTE</h5></center>
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

 
