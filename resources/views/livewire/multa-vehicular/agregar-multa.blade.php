<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
		<br>  
		<center>
			<h3><strong>INGRESAR DATOS {{ $IdMultaingresar }}</strong></h3>
			<h5>
		{{-- 		@if(!isset($Ciudadano)) 
					@foreach ($Ciudadano as $key => $user)
  						{{ $user->Nombres }}&nbsp;{{ $user->Apellidos }}
					@endforeach
				@endif
				{{ $NoIdentificado }} --}} 
			</h5>
		</center> 
		<hr style="width:100%; border-color: blue;"> 
		
		<div class="panel-body"> 
			@include('messages')    
			<hr>
				<center><h5>INGRESAR VEHÍCULO/A</h5></center>
			<hr> 	
			<div id="DivRut">
                <div class="form-group">
                   	<center><label for="Patente">Patente</label></center>
                    <div class="form-label-group"> 
                        <input type="text" class="form-control" wire:model.debounce.1000ms="Patente"  placeholder="Ingrese Patente" autocomplete="off">
                    </div>
                </div>	 
		    </div> 
		  	
			<div wire:loading.delay wire:target="Patente">
              	<center>
      				<h5><strong>BUSCANDO DATOS</strong></h5>
          			<img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
              	</center>
		    </div> 

		    @php   
				$Numero=count($sqlPatentes)
			@endphp 
			<form method="POST" action="{{ route('IngresoMulta') }}"> 
				@csrf  
				<input type="hidden" name="IdMultaingresar" value="{{ $IdMultaingresar }}"> 
				<input type="hidden" name="Hora" value="{{ date('H:i:s') }}"> 
				<input type="hidden" name="Fecha" value="{{ date("d-m-Y") }}"> 
				<input type="hidden" name="Rut" value="{{ $Rut }}"> 
				<input type="hidden" name="Patente" value="{{ $Patente }}">
				@if($Numero!=0) 
					@foreach ($sqlPatentes as $post)
						<input type="hidden" name="TipoVehiculo" value="{{ $post->TipoVehiculo }}">
						<input type="hidden" name="Marca" value="{{ $post->Marca }}">
						<input type="hidden" name="Modelo" value="{{ $post->Modelo }}">
						<input type="hidden" name="Color" value="{{ $post->Color }}">
	                   	<div class="form-group">
						 	<center><label for="TipoVehiculo">TIPO VEHÍCULO</label></center>
	                      	<div class="form-label-group"> 
	                 			<input type="text" class="form-control"  value="{{ $post->TipoVehiculo }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>		
	                   	<div class="form-group">
						 	<center><label for="Apellidos">MARCA</label></center>
	                      	<div class="form-label-group"> 
	                        	<input type="text" class="form-control" value="{{ $post->Marca }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>		
	                   	<div class="form-group">
						 	<center><label for="Profesion">MODELO</label></center>
	                      	<div class="form-label-group"> 
	                        	<input type="text" class="form-control" value="{{ $post->Modelo }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>	
	                   	<div class="form-group">
						 	<center><label for="Nacionalidad">COLOR</label></center>
	                      	<div class="form-label-group">
	                        	<input type="text" class="form-control" value="{{ $post->Color }}" disabled style="background-color:#D3D3D3;">
	                      	</div>
	                   	</div>	                  
        			@endforeach
	        	@else 
            	   	<div class="form-group">
					 	<center><label for="TipoVehiculo">TIPO VEHÍCULO</label></center>
                      	<div class="form-group">
			                <input wire:model="buscarTV" type="text" class="form-control" id="buscarTV" autocomplete="off" placeholder="BUSCAR TIPO VEHÍCULO">
			                @if(!$pickedTV)
			                    <div class="shadow rounded px-3 pt-3 pb-0">
			                        @foreach($TipoVehiculos as $Tipo)
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
			                <input wire:model="buscarM" type="text" class="form-control" id="buscarM" autocomplete="off">
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
                        	<input type="text" class="form-control" name="Modelo" placeholder="Modelo">
                      	</div>
                   	</div>	 
                   	<div class="form-group">
					 	<center><label for="Color">COLOR</label></center>
                      	<div class="form-label-group"> 
                        	<input type="text" class="form-control" name="Color" placeholder="Color">
                      	</div>
                   	</div>
				@endif

					<hr>
					<center><h5>DATOS CITACIÓN</h5></center>
					<hr> 
					 
					<div class="form-group">
					 	<center><label for="Nacionalidad">Juzgado</label></center>
                      	<div class="form-label-group">
                        	<select class="form-control" name="Juzgado" value="{{ old('Juzgado') }}"> 
                                @foreach ($Juzgado as $row)
                                    <option value="{{ $row->id_Juzgado  }}">{{ $row->NombreJuzgado }}</option>
                                @endforeach
                          	</select> 
                     	</div>
                   	</div>	
                   	<div class="form-group"> 
					 	<center><label for="Modelo">Fecha Citación</label></center>
                      	<div class="form-label-group"> 
                        	<input type="date" class="form-control" name="FechaCitacion" value="{{ old('FechaCitacion') }}">
                      	</div>
                   	</div>	
					<hr>
						<center><h5>DATOS INFRACCIÓN</h5></center>
					<hr> 
					<div class="form-group">
					 	<center><label for="TipoInfraccion">Tipo Infracción</label></center>
                      	<input type="hidden" name="TipoInfraccion" value="{{ $id_Infraccion }}"> 
			  			<div class="form-group">
			                <input wire:model="buscar" type="text" class="form-control" id="buscar" autocomplete="off" placeholder="Buscar Tipo Infracción">
			                @if(!$picked)
			                    <div class="shadow rounded px-3 pt-3 pb-0">
			                        @foreach($Infracciones as $Infraccion)
			                            <div style="cursor: pointer;">
			                                <a wire:click="asignarUsuario('{{ $Infraccion->descripcion }}')">
			                                    {{ $Infraccion->descripcion }}
			                                </a>
			                            </div>
			                        @endforeach 
			                    </div>
			                @endif
			            </div>
                   	</div>	 
 					<div class="form-group">
					 	<center><label for="Lugar">Lugar De Infracción</label></center>
                      	<div class="form-label-group"> 
                        	<input type="text" class="form-control" placeholder="Lugar De Infracción" name="Lugar" value="{{ old('Lugar') }}">
                      	</div>
                   	</div>
  					<div class="form-group"> 
					 	<center><label for="Articulo">Infracción Artículo</label></center>
                      	<input type="hidden" name="Articulo" value="{{ $id_Articulo }}"> 
			  			<div class="form-group">
			                <input wire:model="buscarArt" type="text" class="form-control" id="buscarArt" autocomplete="off" placeholder="Buscar Tipo Artículo">
			                @if(!$pickedArt)
			                    <div class="shadow rounded px-3 pt-3 pb-0">
			                        @foreach($InfraccionesArt as $ArticuloL)
			                            <div style="cursor: pointer;">
			                                <a wire:click="asignarArticulo('{{ $ArticuloL->NombreArt }}')">
			                                    {{ $ArticuloL->NombreArt }}
			                                </a>
			                            </div>
			                        @endforeach
			                    </div>
			                @endif 
			            </div>
                   	</div>	 
                   	<div class="form-group">
					 	<center><label for="Nacionalidad">Ingrasar Testigo</label></center>
                      	<div class="form-label-group">
                        	<select class="form-control" name="Testigo"> 
                                @foreach ($Testigo as $row)
                                    <option value="{{ $row->id_inspector }}">{{ $row->Nombres }}</option>
                                @endforeach
                          	</select> 
                     	</div>
                   	</div>	
                   	<div class="form-group">
					 	<center><label for="Modelo">Fotos</label></center>
                      	<div class="form-label-group"> 
                        	<input type="file" class="form-control" name="Fotos">
                      	</div>
                   	</div>
                   	<hr>
                <center>
            		<button type="submit" class="btn btn-info active" >CONTINUAR</button>
            	</center>
			</form>		       
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div>

 
