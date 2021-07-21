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
@if(Auth::guard('web')->check() || Auth::guard('Funcionario')->check())
	  <div class="row">
		  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
		  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			  <br>
			  <div class="panel panel-default">
		      <center>
        		<img src="{{URL::asset('Imagenes/escudo.png')}}" width="220" height="220"/>
        		<hr>
        			<strong>
        				  <h3>{{ $diaFC }} {{ $numeroDiaFC }} de {{ $mesFC }} {{ $anioFC }}</h3>
								      {{ $hoy = date("g:i a")  }}
        			  </strong>
        			<hr>
		      </center>
        </div> 
		  </div>
		  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
	  </div>
@else  	
    <br>
    <div class="row"> 
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
          @include('messages')
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    </div>
    <div class="row"> 
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
       <div class="col"> 
          <div class="card bg-light mb-3">
            <div class="card-header">
              <center><h5><strong>INICIAR SESIÓN</strong></h5></center> 
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('Login') }}">  
                @csrf   
                <div class="form-group">
                  <input type="text" class="form-control" name="RUN" id="RUN" oninput="checkRut(this)" placeholder="Rut" value="{{ old('RUN') }}">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" autocomplete="on">
                </div>
                <div class="btn-group" style=" width:100%;">	
                    <button type="submit" class="btn btn-success active btn-info">Aceptar</button>
                </div>
              </form>
            </div>
            <div class="card-footer text-muted">
              <div class="btn-group" style=" width:100%;">	
                <a href="{{ route('Recuperar') }}" style="color: black;"><center><strong>Recuperar Contraseña</strong></center></a>
              </div>	      
            </div>
          </div>	
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    </div>
@endif
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