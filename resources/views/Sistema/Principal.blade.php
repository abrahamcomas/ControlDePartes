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
  <br>
  <div class="row">  
    <div class="col-sm-12">
      <div class="card-header">
        <h5 class="card-title"><center>SISTEMA INSPECCIÓN DE PARTES<center></h5>
      </div>
    </div>
  </div>
  <br>
  <div class="row">  
    <div class="col-sm-6">
      <div class="card-header">
        MULTA 
      </div>
      <div class="card-body">
          <h5 class="card-title">INGRESAR MULTA</h5>
          <p class="card-text"> Multas ingresadas hoy {{ $Multas }}.</p>
          <a href="{{ route('MultaVehicularCiudadano') }}" class="btn btn-primary">Ingresar Multa</a>
      </div>
      <div class="card-footer text-muted">
          {{ $Anio }} Multas ingresadas durante el año 
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card-header">
         FIRMAS
      </div>
      <div class="card-body">
          <h5 class="card-title">FIRMAR MULTAS</h5>
          <p class="card-text">Al firmar el documento confirma el envío al tribunal.</p>
          <a href="{{ route('FirmarDocumento') }}" class="btn btn-primary">Firmar Documentos</a>
      </div>
      <div class="card-footer text-muted">
          {{ $PendientesFirma }} Firma pendiente
      </div>
    </div>
  </div>
  <br>
  <div class="row">  
    <div class="col-sm-12">
      <div class="card-footer text-muted"> 
      <center><h7>{{ $diaFC }} {{ $numeroDiaFC }} de {{ $mesFC }} {{ $anioFC }}</h7><br></center>
						<center>{{ $hoy = date("g:i a")  }}</center>
      </div>
    </div>
  </div>


</div>


@endsection