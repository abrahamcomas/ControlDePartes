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
							<h4><u>Municipalidad de Curicó</u></h4>
								<strong>
									<h5>Sistema Control de partes</h5>
									Multa N°{{ $Juzgado }}{{ $NumeroParteIngr }}{{ $AnioMulta }}
								</strong>
						</center>
					</table>

					<table>
	        			<center>
		        			@foreach($datos as $post)
		        					<hr>
									<strong>TIPO NOTIFICACIÓN = PERSONALMENTE</strong> 
									<hr>
		        					<strong>DATOS VEHÍCULO</strong> 
		        					<hr>
			        				PATENTE = {{ $post->PlacaPatente  }}
			        			 
			        				<hr>
			        				<strong>DATOS CITACIÓN</strong> 
		        					<hr>
			        				CITACIÓN = {{ $post->NombreJuzgado  }}
			        				<br>
			        			@if($TipoInfraccion==2)
                   					A ESPERA DE CITACIÓN POR PARTE DEL JUZGADO.
			        			@else
									FECHA CITACIÓN = {{ $post->FechaCitacion  }}
									<br>
									HORA = 09:15 AM
			        			@endif
			        				<hr>
			        				<strong>DATOS INFRACCIÓN</strong> 
		        					<hr>
			        				MOTIVO = {{ $post->descripcion }}
			        				<br>
			        				LUGAR = {{ $post->Lugar }}
			        				<br>
			        				HORA = {{ $post->Hora }}
			        				<br>
			        				FECHA = {{ $post->Fecha }}
			        				<br>
			        				INSPECTOR = {{ $post->Nombres }}&nbsp;{{ $post->ApellidosInsp }}
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