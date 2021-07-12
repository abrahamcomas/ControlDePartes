@extends('App')
@section('content')
  @php
    $FechaCitacion=date("Y-m-d");
    $numeroDiaFC = date('d', strtotime($FechaCitacion));
    $diaFC = date('l', strtotime($FechaCitacion));
    $mesFC = date('F', strtotime($FechaCitacion));
    $anioFC = date('Y', strtotime($FechaCitacion));
     
    if($mesFC=='January'){
      $mesFC= 'Enero';
      }
    elseif($mesFC=='February'){   
      $mesFC= 'Febrero';
      }
    elseif($mesFC=='March'){  
      $mesFC= 'Marzo';
      }
    elseif($mesFC=='April'){
         $mesFC= 'Abril';
      }
    elseif($mesFC=='May'){
         $mesFC= 'Mayo';
      }
    elseif($mesFC=='June'){
         $mesFC= 'Junio';
      }
    elseif($mesFC=='July'){ 
         $mesFC= 'Julio';
      }
    elseif($mesFC=='August'){  
         $mesFC= 'Agosto';
      }
    elseif($mesFC=='September'){  
         $mesFC= 'Septiembre';
      }
    elseif($mesFC=='October'){  
         $mesFC= 'Octubre';
      }
    elseif($mesFC=='November'){  
         $mesFC= 'Noviembre';
      }
    else{  
         $mesFC= 'Diciembre';
      }

    if($diaFC=='Monday'){
      $diaFC= 'Lunes';
      }
    elseif($diaFC=='Tuesday'){   
      $diaFC= 'Martes';
      }
    elseif($diaFC=='Wednesday'){  
      $diaFC= 'Miércoles';
      }
    elseif($diaFC=='Thursday'){
         $diaFC= 'Jueves';
      }
    elseif($diaFC=='Friday'){
         $diaFC= 'Viernes';
      }
    elseif($diaFC=='Saturday'){
         $diaFC= 'Sábado'; 
      }
    else{ 
         $diaFC= 'Domingo';
      }
  @endphp
<div class="container-fluid">  
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<br>
			<div class="panel panel-default">
				@include('messages')
				@if(Auth::guard('web')->check() || Auth::guard('Funcionario')->check())
		         	<center>
    		 		    <div id="ContenidoDercHead">
        			        <img src="{{URL::asset('Imagenes/escudo.png')}}" width="220" height="220"/>
      			        </div>
        			    <hr>
        			      	<strong>
        				      	<h3>{{ $diaFC }} {{ $numeroDiaFC }} de {{ $mesFC }} {{ $anioFC }}</h3>
								{{ $hoy = date("g:i a")  }}
        			      	</strong>
        			      	<hr>
		        	</center>
				@else  
					<div class="panel-heading">
						<center><h3><strong>INICIAR SESIÓN</strong></h3></center> 
						<hr style="width:100%; border-color: blue;">
					</div>
					<div class="panel-body">
						<form method="POST" action="{{ route('Login') }}">  
							@csrf   
							<div class="form-group">
		                      	<div class="form-label-group">
		                        	<input type="text" class="form-control" name="RUN" id="RUN" oninput="checkRut(this)" placeholder="Rut" value="{{ old('RUN') }}">
		                      	</div>
		                    </div>
		                    <div class="form-group">
		                      	<div class="form-label-group">
		                        	<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                   	<hr style="width:100%; border-color: blue;">
		                   	<center><button type="submit" class="btn btn-success active btn-info">Aceptar</button></center>
		                   	<br>
		                   	<a href="{{ route('Recuperar') }}" style="color: black;">
		      				<center><strong>Recuperar Contraseña</strong></center></a>
						</form>
					</div>
				@endif
			</div> 
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
	        window.addEventListener( "pageshow", function ( event ) {
			  	var historyTraversal = event.persisted || 
			                         ( typeof window.performance != "undefined" && 
			                              window.performance.navigation.type === 2 );
			  	if ( historyTraversal ) {
			   	 	// Handle page restore.
			    	window.location.reload();
			  	}
			});
	});	
</script>
@endsection