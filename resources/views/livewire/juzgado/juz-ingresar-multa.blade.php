<div>
		@if($ConfirmarIngreso==0)
		@if($Detalles==0)
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="col">
						<div class="card bg-light mb-3" >
							<div class="card-header">
								<table table class="table table-hover"> 
									<thead>
									<center><strong><h2>MULTAS</h2></strong></center> 
										<tr> 
											<th><center>N°</center></th>
											<th><center>PLACA</center></th>
											<th><center>DETALLES</center></th>
										</tr>
									</thead>  
								</table>
							</div>
							<div class="card-body">
								<table table class="table table-hover">
									<tbody> 
										@foreach($posts as $post)
										<tr>
											<td><center>{{ $post->Id_Juzgado }}{{ $post->NumeroParte }}{{ $post->Anio }}</center></td>
											<td><center>{{ $post->PlacaPatente  }}</center></td>
											<td> 
												<center>
													<button class="btn btn-primary" wire:click="M_Detalles({{ $post->Id_Multas }})">Detalles</button>
												</center>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="card-footer text-muted">
								{{ $posts->links() }}
							</div>	
						</div>	
					</div>	
				</div>	 
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
			</div>
		@else
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
						<div class="col">
						<div class="btn-group" style=" width:100%;">	
							<button class="btn btn-danger active" wire:click="VolverDetalles">
								Volver
							</button>
							</div> 
							<div class="card bg-light mb-3" >
								<div class="card-header">
								@foreach ($Datos as $post)
									<center><strong><h5>DETALLES</h5></strong></center> 
									<hr>
									<form method="POST" action="{{ route('MostrarMultaPDF2') }}">   
                                        @csrf             
                                        <input type="hidden" name="ID" value="{{ $post->Id_Multas  }}">
                                        <div class="btn-group" style=" width:100%;">	
                                            <button type="submit" class="btn btn-primary active" formtarget="_blank">PDF</button>
                                        </div>
                                    </form>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table table class="table table-hover">
														<div class="form-group">
															<center>PATENTE</center>
															<div class="form-label-group"> 
																<input type="text" class="form-control" value="{{ $post->PlacaPatente }}" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div>  
													@if($post->TipoNotificacion==3)
														<div class="form-group">
															<center>TIPO NOTIFICACIÓN</center>
															<div class="form-label-group">  
																<input type="text" class="form-control" value="Personalmente" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div>  
														<div class="form-group">
															<center>NOMBRE</center>
															<div class="form-label-group"> 
																<input type="text" class="form-control" value="{{ $post->NombresC }}&nbsp;{{ $post->ApellidosCiu }}" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div>   
														<div class="form-group">
															<center>RUT</center>
															<div class="form-label-group"> 
																<input type="text" class="form-control" value="{{ $post->RutCiudadano }}" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div>
														<div class="form-group">
															<center>PROFESIÓN</center>
															<div class="form-label-group"> 
																<input type="text" class="form-control" value="{{ $post->Profesion }}" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div>
														<div class="form-group">
															<center>NACIONALIDAD</center>
															<div class="form-label-group"> 
																<input type="text" class="form-control" value="{{ $post->NombreNac }}" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div>
														<div class="form-group">
															<center>NACIONALIDAD</center>
															<div class="form-label-group"> 
																<input type="text" class="form-control" value="{{ $post->NombreNac }}" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div>        
														<div class="form-group">
															<center>DOMICILIO</center>
															<div class="form-label-group"> 
																<input type="text" class="form-control" value="{{ $post->Domicilio }}" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div>               
													@elseif($post->TipoNotificacion==2)
														<div class="form-group">
															<center>TIPO NOTIFICACIÓN</center>
															<div class="form-label-group"> 
																<input type="text" class="form-control" value="Empadronado" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div> 
													@else
														<div class="form-group">
															<center>TIPO NOTIFICACIÓN</center>
															<div class="form-label-group"> 
																<input type="text" class="form-control" value="POR ESCRITO" 
																disabled style="background-color:#D3D3D3;">
															</div>
														</div>    
													@endif
													<center><strong>DATOS VEHÍCULO</strong> </center>
													<hr>
													<div class="form-group">
														<center>TIPO VEHÍCULO</center>
														<div class="form-label-group"> 
															<input type="text" class="form-control" value="{{ $post->V_Descripcion }}" 
															disabled style="background-color:#D3D3D3;">
														</div>
													</div>      
													<div class="form-group">
														<center>MARCA</center>
														<div class="form-label-group"> 
															<input type="text" class="form-control"value="{{ $post->Marca }}"
															disabled style="background-color:#D3D3D3;">
														</div>
													</div>      
													<div class="form-group">
														<center>MODELO</center>
														<div class="form-label-group"> 
															<input type="text" class="form-control" value="{{ $post->Modelo }}" 
															disabled style="background-color:#D3D3D3;">
														</div>
													</div>  
													<div class="form-group">
														<center>COLOR</center>
														<div class="form-label-group">
															<input type="text" class="form-control" value="{{ $post->Color }}" 
															disabled style="background-color:#D3D3D3;">
														</div>
													</div>                                    
													<hr> 
													<center><strong>DATOS CITACIÓN</strong></center>
													<hr> 
													<div class="form-group">
														<center>JUZGADO</center>
														<div class="form-label-group"> 
															<input type="text" class="form-control" value="{{ $post->NombreJuzgado }}"
															disabled style="background-color:#D3D3D3;">
														</div>
													</div> 
													<div class="form-group">
														<center>FECHA CITACIÓN</center>
														<div class="form-label-group"> 
															<input type="text" class="form-control" value="{{ $post->FechaCitacion }}"
															disabled style="background-color:#D3D3D3;">
														</div>
													</div> 
													<hr>
														<center><strong>DATOS INFRACCIÓN</strong></center>
													<hr> 
													<div class="form-group"> 
														<center><label for="Modelo">DESCRIPCIÓN INFRACCIÓN</label></center>
														<div class="form-label-group"> 
															<textarea class="md-textarea form-control" rows="3" disabled>{{ $post->descripcion }}</textarea>
														</div>
													</div> 
													<div class="form-group"> 
														<center><label for="Modelo">LUGAR DE INFRACCIÓN</label></center>
														<div class="form-label-group"> 
															<textarea class="md-textarea form-control" rows="3" disabled>{{ $post->Lugar }}</textarea>
														</div>
													</div> 
													<div class="form-group"> 
														<center><label for="Modelo">HORA INFRACCIÓN</label></center>
														<div class="form-label-group"> 
															<input type="text" class="form-control" value="{{ $post->Hora }}"
															disabled style="background-color:#D3D3D3;">
														</div>
													</div> 
													<div class="form-group">
														<center>INFRACCIÓN ARTÍCULO</center>
														<div class="form-label-group"> 
															<input type="text" class="form-control" value="{{ $post->InfraccionArticulo }}"
															disabled style="background-color:#D3D3D3;">
														</div>
													</div> 
													<div class="form-group">
														<center><label for="Lugar">FECHA INFRACCIÓN</label></center>
														<div class="form-label-group"> 
															<input type="text" class="form-control" value="{{ $post->Fecha }}"
															disabled style="background-color:#D3D3D3;">
														</div>
													</div>
												@endforeach  
												@foreach($Testigo as $post)
													<div class="form-group">
														<center><label for="Lugar">TESTIGO</label></center>
														<div class="form-label-group"> 
															<input type="text" class="form-control" value="{{ $post->Nombres }}&nbsp;{{ $post->Apellidos }}"
															disabled style="background-color:#D3D3D3;">
														</div>
													</div>
								
												@if($Imagenes!='[]')
													@foreach($Imagenes as $post) 
														<tr>
															<td> 
																<center>
																	<a href="{{ $post->RutaImagen }}" download>
																		<img src="{{ $post->RutaImagen }}" alt="Foto" width="500" height="500"/>
																	</a>
																</center>
															</td>
														</tr>
													@endforeach
												@else
													<tr>
														<td>
															<center>
																<h4>FOTO NO DISPONIBLE</h4>
															</center>
														</td>
													</tr>
												@endif        
											@endforeach
										</table> 
									</div>
								</div>
								<div class="card-footer text-muted">
									<div class="btn-group" style=" width:100%;">	
										<button class="btn btn-primary active" data-toggle="modal" wire:click="ConfirmarIngreso">Ingresar</button>
									</div>	
								</div>	
							</div>
						</div>                                          
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
				</div>	           			
			@endif
		@else
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="col">
						<div class="card bg-light mb-3" >
							<div class="card-header">
								<center><h5>¿Confirmar ingreso?</h5></center>
							</div>
							<div class="card-body"> 
								<center>
									<strong>
										<h3>
											@foreach ($Datos as $post)
												{{ $post->PlacaPatente }}
											@endforeach 
										</h3>
									</strong>
									
								</center>
							</div>
							<div class="btn-group">
								<button class="btn btn-danger btn-lg" data-toggle="modal" wire:click="CancelarConfirmarIngreso">Cancelar</button>
								<button class="btn btn-success btn-lg" data-toggle="modal" wire:click="IngresarMulta({{ $Id_Multas }})">Confirmar</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
			</div>
		@endif
</div>
 