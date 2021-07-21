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

<meta charset="utf-8">
<title>Control De Partes</title>
<head>
	<meta name="viewport" content="width=device-width"/>





	<!--Para que funione el ajax-->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

	{{-- Error con datatable --}}
	{{-- 	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> 
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" >
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">

	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> 
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script> 
	<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script> 
	<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script> 

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<link rel="stylesheet" href="{{ asset ('css/bootstrap.min.css') }}" >
	<link rel="stylesheet" href="{{ asset ('ManuLateral/simple-sidebar.css ') }}" >

	

	<script type="text/javascript">
		function checkRut(rut) 
		    {
			    var valor = rut.value.replace('.','');
			    valor = valor.replace('-','');
			    cuerpo = valor.slice(0,-1);
			    dv = valor.slice(-1).toUpperCase(); 
			    rut.value = cuerpo + '-'+ dv
			    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
			    suma = 0;
			    multiplo = 2;
			    for(i=1;i<=cuerpo.length;i++) {
			        index = multiplo * valor.charAt(cuerpo.length - i);
			        suma = suma + index;
			        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
			    }
			    dvEsperado = 11 - (suma % 11);
			    dv = (dv == 'K')?10:dv;
			    dv = (dv == 0)?11:dv;
			    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
			    rut.setCustomValidity('');

	    }

		function Patente1(Patente1) 
		    {
			    var valor = Patente1.value.replace('.','');
				valor = valor.toUpperCase();
			    valor = valor.replace('-','');
			    cuerpo = valor.slice(0,-4);
			    dv = valor.slice(-4).toUpperCase(); 
			    Patente1.value = cuerpo + '-'+ dv
			   
	    }
 
		function Patente2(Patente2) 
		    {
			    var valor = Patente2.value.replace('.','');
				valor = valor.toUpperCase();
			    valor = valor.replace('-','');
			    cuerpo = valor.slice(0,-3);
			    dv = valor.slice(-3).toUpperCase(); 
			    Patente2.value = cuerpo + '-'+ dv
			  
	    }
		function Patente3(Patente3) 
		    {
			    var valor = Patente3.value.replace('.','');
				valor = valor.toUpperCase();
			    valor = valor.replace('-','');
			    cuerpo = valor.slice(0,-2);
			    dv = valor.slice(-2).toUpperCase(); 
			    Patente3.value = cuerpo + '-'+ dv
			  
	    }

	    //IMPRIMIR PDF COMPROBANTE MULTA
		function imprSelec(nombre) {
		  var ficha = document.getElementById(nombre);
		  var ventimp = window.open(' ', 'popimpr');
		  ventimp.document.write( ficha.innerHTML );
		  ventimp.document.close();
		  ventimp.print( );
		  ventimp.close();
		}

	</script>
	<style type="text/css">

		#h { 

	        height:auto;
	        background: #1B67AE;
	        background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(76, 25, 88,.1) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(255, 255, 255,.25) 0%, rgba(0, 0, 0,.1) 100%), -moz-linear-gradient(-45deg,  #1B67AE 0%, #1B67AE 100%);
	        background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(76, 25, 88,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(255, 255, 255,.25) 0%,rgba(76, 25, 88) 100%), -webkit-linear-gradient(-45deg,  #1B67AE 0%,#1B67AE 100%);
	        background: -o-radial-gradient(0% 100%, ellipse cover, rgba(76, 25, 88,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(255, 255, 255,.25) 0%,rgba(76, 25, 88) 100%), -o-linear-gradient(-45deg,  #1B67AE 0%,#1B67AE 100%);
	        background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(76, 25, 88,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(255, 255, 255,.25) 0%,rgba(76, 25, 88) 100%), -ms-linear-gradient(-45deg,  #1B67AE 0%,#1B67AE 100%);
	        background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(76, 25, 88,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(255, 255, 255,.25) 0%,rgba(76, 25, 88) 100%), linear-gradient(135deg,  #1B67AE 0%,#1B67AE 100%);

	    }
	</style> 

	<nav class="navbar navbar-expand-lg navbar-light bg-light" id="h">

		
	@if (Route::has('Index'))  
			<div class="top-right link">	 
				@if(Auth::guard('web')->check())
					<a style="color: white;">
						<button class="btn btn-info active" id="menu-toggle">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-border-width" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  	<path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-2zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
							</svg>
						</button> 
						Bienvenido 
						{{ Auth::user()->Nombres}} 
						{{ Auth::user()->Apellidos }}
					</a>
				@elseif(Auth::guard('Funcionario')->check())
					<a style="color: white;">
						<strong>
							<button class="btn btn-info active" id="menu-toggle">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-border-width" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  		<path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-2zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
								</svg>
							</button>
							<a  href="{{ route('Index') }}" style="color: white;">&nbsp;
							Bienvenido 
							{{ Auth::guard('Funcionario')->user()->Nombres }}
							{{ Auth::guard('Funcionario')->user()->Apellidos }}</a>
						</strong>
					</a>
				@else
					<a class="navbar-brand" href="#" style="color: white; font-size:16px;"><STRONG>SISTEMA CONTROL DE PARTES</STRONG></a>		
				@endif
			</div>
		@endif		  
	  	<ul class="navbar-nav ml-auto mt-2 mt-lg-0"> 
	    	@if (Route::has('Index')) 
	      		@if(Auth::guard('web')->check())
      				<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#logoutModal" >
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
							<path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
						</svg>
					</a>
			   	@elseif(Auth::guard('Funcionario')->check())
      				<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#logoutModal2" >
      					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  							<path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  							<path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
						</svg>
					</a>
	      		@else	
					<a href="{{ route('Registrarse') }}" style="color: white;">
					<center><strong>Registrarse</strong></center></a>
	    		@endif
			@endif
  		</ul>
	</nav>
	@livewireStyles
</head> 
<body> 
  	@if(Auth::guard('web')->check())
  		<div class="d-flex" id="wrapper"> 
			<div class="bg-light border-right" id="sidebar-wrapper">
      			<div class="sidebar-heading"><strong><center>MENÚ</center></strong></div>
				<div class="list-group list-group-flush">
					<div class="dropdown">
						<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" 
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MULTAS&nbsp;</a>
				  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
							<!--<a href="{{ route('FirmarDocumento2') }}" class="list-group-item list-group-item-action">FIRMAR DOCUMENTO2</a>-->
							<form method="POST" action="{{ route('MultaVehicularCiudadano') }}">
								@csrf
								<button type="submit" class="btn">
									<a >INGRESAR MULTA</a>
								</button>
							</form>
							<!--<a href="{{ route('MultaVehicularCiudadano') }}" class="list-group-item list-group-item-action">INGRESAR MULTA</a>--> 
						</div>		
					</div>		
				
					<div class="dropdown">
						<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" 
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">FIRMAR&nbsp;</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
							<form method="POST" action="{{ route('FirmarDocumento') }}">
								@csrf
								<button type="submit" class="btn">
									<a>MOSTRAR MULTAS</a>
								</button>
							</form>
							<!--<a href="{{ route('FirmarDocumento') }}" class="list-group-item list-group-item-action">FIRMAR DOCUMENTO</a>--> 
						</div>		
					</div>

					<div class="dropdown">
			  			<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" 
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MULTAS&nbsp;</a>
				  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
						  <form method="POST" action="{{ route('ListaDeMultas') }}">
                        		@csrf
								<button type="submit" class="btn">
									<a>MULTAS</a>
								</button>
							</form>
							<!--<a class="list-group-item list-group-item-action" href="{{ route('ListaDeMultas') }}">MULTAS</a>-->

							<form method="POST" action="{{ route('ListaMultasIngresadas') }}">
								@csrf
								<button type="submit" class="btn">
									<a>MULTAS INGRESADAS</a>
								</button>
							</form>
				    		<!--<a class="list-group-item list-group-item-action" href="{{ route('ListaMultasIngresadas') }}">MULTAS INGRESADAS</a>-->
				  		</div> 
					</div>  
					
					<div class="dropdown">
			  			<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" 
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">REPORTES&nbsp;</a>
				  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
						  <form method="POST" action="{{ route('SacarReporte') }}">
								@csrf
								<button type="submit" class="btn">
									<a>SACAR REPORTE</a>
								</button>
							</form>
				    		<!--<a class="list-group-item list-group-item-action" href="{{ route('SacarReporte') }}">SACAR REPORTE</a>-->
				  		</div>
					</div>
					
					<div class="dropdown">
			  			<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" 
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANTENEDORES&nbsp;</a>
				  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
						  <form method="POST" action="{{ route('EditarCiudadano') }}">
								@csrf
								<button type="submit" class="btn">
									<a>EDITAR CIUDADANO</a>
								</button>
							</form>
				    		<!--<a class="list-group-item list-group-item-action" href="{{ route('EditarCiudadano') }}">EDITAR CIUDADANO</a>-->

							<form method="POST" action="{{ route('AgregarTiposInfra') }}">
								@csrf
								<button type="submit" class="btn">
									<a>AGREGAR INFRACCIONES</a>
								</button>
							</form> 
				    		<!--<a class="list-group-item list-group-item-action" href="{{ route('AgregarTiposInfra') }}">AGREGAR TIPOS INFRACCIONES</a>-->

							<form method="POST" action="{{ route('AgregarArticulo') }}">
								@csrf
								<button type="submit" class="btn">
									<a>AGREGAR ARTÍCULOS</a>
								</button>
							</form>
				    		<!--<a class="list-group-item list-group-item-action" href="{{ route('AgregarArticulo') }}">AGREGAR INFRACIONES ARTÍCULOS</a>-->
				  		</div>
				  	</div>
	
					<div class="dropdown">
			  			<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" 
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPCIONES&nbsp;</a>
				  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
						    <form method="POST" action="{{ route('CambiarCorreo') }}">
								@csrf
								<button type="submit" class="btn">
									<a>EMAIL</a>
								</button>
							</form>
				    		<!--<a class="list-group-item list-group-item-action" href="{{ route('CambiarCorreo') }}">EMAIL</a>-->

							<!--<form method="POST" action="{{ route('CambiarContrasenia') }}">
								@csrf
								<button type="submit" class="btn">
									<a>CONTRASEÑA</a>
								</button>
							</form>-->
							<!--<a class="list-group-item list-group-item-action" href="{{ route('CambiarContrasenia') }}">CONTRASEÑA</a>-->
				  		</div>
				  	</div>
					<div class="dropdown">
			  			<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" 
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">DISP. VINCULADOS&nbsp;</a>
				  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
							<form method="POST" action="{{ route('Sessiones') }}">
								@csrf
								<button type="submit" class="btn">
									<a>DISP. VINCULADOS</a>
								</button>
							</form>
							<!--<a href="{{ route('Sessiones') }}" class="list-group-item list-group-item-action">DISP. VINCULADOS</a> -->
						</div>
				  	</div>
				</div>
				<br><br>
				<div>
					<center><img src="{{URL::asset('Imagenes/escudo.png')}}" width="90" height="90"/></center>
					<hr>
					<center>
					  	© {{ date("Y") }} Dep. de informática V0.1<br>
						Municipalidad de Curicó
					</center>
				</div>
			</div> 
	@elseif(Auth::guard('Funcionario')->check())
			<div class="d-flex" id="wrapper"> 
				<div class="bg-light border-right" id="sidebar-wrapper">
					<div class="sidebar-heading"><strong><center>MENÚ</center></strong></div>
					<div class="list-group list-group-flush">
						<div class="dropdown">
							<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">JUZGADO&nbsp;</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
								<a class="list-group-item list-group-item-action" href="{{ route('JuzListaDeMultas') }}">MULTAS</a>
								<a class="list-group-item list-group-item-action" href="{{ route('JuzMultasIngr') }}">MULTAS INGRESADAS</a>
								<a class="list-group-item list-group-item-action" href="{{ route('JuzReportes') }}">REPORTES</a>
							</div>
						</div>
					</div>
				</div> 
				<div class="dropdown">
					<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPCIONES&nbsp;</a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
						<a class="list-group-item list-group-item-action" href="{{ route('CambiarCorreo2') }}">EMAIL</a>
						<a class="list-group-item list-group-item-action" href="{{ route('CambiarContrasenia2') }}">CONTRASEÑA</a>
					</div>
				</div> 
	@endif
		
		    <div id="page-content-wrapper"> 
		    	@if(Auth::guard('Funcionario')->check())
			    	@if(Auth::guard('Funcionario')->user()->ID_Juzgado_T==1)
						<center><STRONG>PRIMER JUZGADO DE POLICIA LOCAL</STRONG></center> 
						<hr>
					@else
						<center><STRONG>SEGUNDO JUZGADO DE POLICIA LOCAL</STRONG></center>
						<hr>
					@endif
				@endif
				@yield("content")
				@livewireScripts
				@yield('scripts')
				@yield("foot")
		    </div>
		</div>
</body>
<script>
	$("#menu-toggle").click(function(e) {
	      	e.preventDefault();
	      	$("#wrapper").toggleClass("toggled");
	});
</script>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">¿Cerrar Sesión?</h5>
		        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">X</span>
		        </button>
      		</div>
      		<div class="modal-body"><center><img src="{{URL::asset('Imagenes/escudo.png')}}" width="120" height="120"/></center></div>
			<br>
			<div class="btn-group">
				<button class="btn btn-danger active" type="button" data-dismiss="modal">Cancelar</button>
        		<a class="btn btn-primary active" href="{{ route('CerrarSesion') }}">Aceptar</a>
      		</div>
    	</div>
 	</div>
</div> 


<div class="modal fade" id="logoutModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel2">¿Cerrar Sesión?</h5>
        		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">X</span>
        		</button>
      		</div>
      		<div class="modal-body"><center><img src="{{URL::asset('Imagenes/escudo.png')}}" width="120" height="120"/></center></div>
			<br>
			<div class="btn-group">
				<button class="btn btn-danger active" type="button" data-dismiss="modal">Cancelar</button>
        		<a class="btn btn-primary active" href="{{ route('CerrarSesion2') }}">Aceptar</a>
      		</div>
    	</div> 
  </div>
</div>