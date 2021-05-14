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
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			      <br>
			      @include('messages')
		        <div class="panel panel-default">
			          <center>
    		 		        <div id="ContenidoDercHead">
        			          <img src="{{URL::asset('Imagenes/escudo.png')}}" width="220" height="220"/>
      			        </div>
        			      <hr>
        			      <strong>
        				      <h3>{{ $diaFC }} {{ $numeroDiaFC }} de {{ $mesFC }} {{ $anioFC }}</h3>

{{ $hoy = date("g:i a")  }}
                      <h1> </h1>
        			      </strong>
        			      <hr>
    		        </center>
			      </div> 
		    </div>
	      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
	  </div>
</div>
@endsection