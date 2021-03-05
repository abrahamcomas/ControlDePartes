<div>
	<div class="container-fluid"> 
	<br> 
	<center><strong><h1>MULTAS PENDIENTES</h1></strong></center> 
	<hr>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<center><h3><strong>PATENTES</strong></h3></center>
				<hr>
				<table table class="table table-hover">
		        	<thead>
		        		<tr> 
		        			<th><center>Placa</center></th>
		                    <th><center>Detalles</center></th>
		        		</tr>
		        	</thead>
		        	<tbody> 
		        		@foreach($posts as $post)
		        		<tr>
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
	         	{{ $posts->links() }}
			</div>	 
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	            @foreach ($Datos as $post)
	            <center><h3><strong>DETALLES PATENTE {{ $post->PlacaPatente }}</strong></h3></center>
	            <hr> 
	            	@if($post->TipoNotificacion==1)
                        <div class="form-group">
		                    <center>TIPO NOTIFICACIÓN</center>
		                    <div class="form-label-group"> 
		                        <input type="text" class="form-control" value="ESCRITO" 
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
                    @else
                        <div class="form-group">
		                    <center>TIPO NOTIFICACIÓN</center>
		                    <div class="form-label-group"> 
		                        <input type="text" class="form-control" value="PERSONALMENTE" 
		                        disabled style="background-color:#D3D3D3;">
		                    </div>
	                	</div>  
                    @endif
					<center><strong>DATOS VEHÍCULO</strong> </center>
                    <hr>
	                <div class="form-group">
	                    <center>TIPO VEHÍCULO</center>
	                    <div class="form-label-group"> 
	                        <input type="text" class="form-control" value="{{ $post->TipoVehiculo }}" 
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
	                    <center>Juzgado</center>
	                    <div class="form-label-group"> 
	                        <input type="text" class="form-control" value="{{ $post->NombreJuzgado }}"
	                        disabled style="background-color:#D3D3D3;">
	                    </div>
	                </div> 
	                <div class="form-group">
	                    <center>Fecha Citación</center>
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
	                    <center><label for="Modelo">Lugar De Infracción</label></center>
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
	                    <center>Infracción Artículo</center>
	                    <div class="form-label-group"> 
	                        <input type="text" class="form-control" value="{{ $post->NombreArt }}"
	                        disabled style="background-color:#D3D3D3;">
	                    </div>
	                </div> 
	                <div class="form-group">
	                    <center>Infracción Artículo</center>
	                    <div class="form-label-group"> 
	                        <input type="text" class="form-control" value="{{ $post->NombreArt }}"
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
	                <div class="form-group">
	                    <center><label for="Lugar">NOMBRE INSPECTOR</label></center>
	                     <div class="form-label-group"> 
	                        <input type="text" class="form-control" value="{{ $post->Nombres }}&nbsp;{{ $post->ApellidosInsp }}"
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
	                <div class="form-group">
						<center>
               				<button class="btn btn-primary" data-toggle="modal" data-target="#IngresoMulta">Ingresado</button>
            			</center>
	            	</div>
                @endforeach
	           
	        </div>
    	</div>
    </div>
	<div class="modal fade" id="IngresoMulta" tabindex="-1" role="dialog" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h4><strong>SISTEMA CONTROL DE PARTES</strong></h4>
	      		</div>
	      		<div class="modal-body">
	      			<h5 class="modal-title" id="exampleModalLabel">¿Confirmar Ingresos Patente 
	        			<strong>
	        				@foreach ($Datos as $post)
	            			{{ $post->PlacaPatente }}
	            		@endforeach
	        			</strong>
	        			 ? 
	      				</div>
	      			<div class="modal-footer">
	        			<button class="btn btn-secondary active" type="button" data-dismiss="modal">Cancelar</button>
	        			<button class="btn btn-primary" wire:click="IngresarMulta({{ $Id_Multas }})" onClick="location.reload();">
	        			Aceptar</button>
	      			</div>
	  		</div>
		</div>
	</div>
</div>
 