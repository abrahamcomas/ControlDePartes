@extends('App')
@section('content')
<div class="container-fluid"> 
	<br>
	@include('messages')
	<div class="panel panel-default"> 
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
				<div id="Multa"> 
					<table> 
						<center>
							<h5><u>Municipalidad de Curicó</u></h5>
							
							@foreach($datos as $post1)
								<strong><h4>Sistema Control de partes</h4>Multa N°{{ $post1->Id_Multas }}</strong>
							@endforeach
						</center>
					</table>

					<table>
	        			<center>
		        			@foreach($datos as $post)
		        				@if($post->TipoNotificacion==1)
		        					<hr>
									<strong>TIPO NOTIFICACIÓN = ESCRITO</strong> 
									<hr>
									NOMBRE = {{ $post->NombresC }}&nbsp;{{ $post->ApellidosCiu }}
			        				<br>
			        				RUT = {{ $post->PlacaPatente }}
			        				<br>
			        				PROFESIÓN = {{ $post->Profesion }}
			        				<br>
			        				NACIONALIDAD = {{ $post->NombreNac }}
			        				<br>
			        				DOMICILIO = {{ $post->Domicilio }}
			        				<hr>
		        				@else
		        					<hr>
									<strong>TIPO NOTIFICACIÓN = PERSONALMENTE</strong> 
									<hr>
		        				@endif
		        					<strong>DATOS VEHÍCULO</strong> 
		        					<hr>
			        				PATENTE = {{ $post->PlacaPatente  }}
			        				<br>
			        				TIPO VEHÍCULO = {{ $post->TipoVehiculo  }}
			        				<br>
			        				MARCA = {{ $post->Marca  }}
			        				<br>
			        				MODELO = {{ $post->Modelo  }}
			        				<br>
			        				COLOR = {{ $post->Color  }}
			        				<hr>
			        				<strong>DATOS CITACIÓN</strong> 
		        					<hr>
			        				CITACIÓN = {{ $post->NombreJuzgado  }}
			        				<br>
			        				FECHA CITACIÓN = {{ $post->FechaCitacion  }}
									<hr>
			        				<strong>DATOS INFRACCIÓN</strong> 
		        					<hr>
			        				DESCRIPCIÓN INFRACCIÓN = {{ $post->descripcion }}
			        				<br>
			        				LUGAR DE LA INFRACCIÓN = {{ $post->Lugar }}
			        				<br>
			        				HORA INFRACCIÓN = {{ $post->Hora }}
			        				<br>
			        				INFRACCIÓN ARTICULO = {{ $post->id_Articulo }}
			        				<br>
			        				FECHA INFRACCIÓN = {{ $post->Fecha }}
			        				<br>
			        				NOMBRE INSPECTOR = {{ $post->Nombres }}&nbsp;{{ $post->ApellidosInsp }}
			        				<br>
		        			@endforeach
							@foreach($Testigo as $post)
		        				TESTIGO = {{ $post->Nombres }}&nbsp;{{ $post->Apellidos }}
		        			@endforeach
			        				<br>
		        			<hr>
		        		</center>
		        	</table>
				</div>	
				<center>
					<a class="btn btn-info active" href="javascript:imprSelec('Multa')" >Imprimir Comprobante</a>
				</center>
			</div> 
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		</div>
	</div>
</div>
@endsection