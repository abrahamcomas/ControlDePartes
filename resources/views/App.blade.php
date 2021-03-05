<meta charset="utf-8">
<title>Control De Partes</title>
<head>
	<meta name="viewport" content="width=device-width"/>
	<link href="{{ asset ('css/bootstrap.min.css') }}" rel="stylesheet">


	<link href="{{ asset ('ManuLateral/simple-sidebar.css ') }}" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<!--Para que funione el ajax-->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

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
				@if(Auth::guard()->check())
					<a class="navbar-brand" href="#" style="color: white;">
						<strong>
							<button class="btn btn-info active" id="menu-toggle">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-border-width" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  		<path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-2zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
								</svg>
							</button>
							Bienvenido 
							{{ Auth::user()->Nombres}} 
							{{ Auth::user()->Apellidos }}
						</strong>
					</a>
				@else
					<a class="navbar-brand" href="#" style="color: white;"><STRONG>SISTEMA CONTROL DE PARTES</STRONG></a>		
				@endif
			</div>
		@endif		 
	  	<ul class="navbar-nav ml-auto mt-2 mt-lg-0"> 
	    	@if (Route::has('Index')) 
		      		@if(Auth::guard()->check())
		      			<li class="nav-item dropdown">
				            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
				                <strong>Opciones</strong> 
				            </a>
				            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				                <a class="dropdown-item" href="{{ route('CambiarCorreo') }}" style="font-size:14px;">	 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-at" 
				    					fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										  <path fill-rule="evenodd" d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
									</svg>&nbsp;Email
								</a>
				                <a class="dropdown-item" href="{{ route('CambiarContrasenia') }}" style="font-size:14px;">	 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" 
					    				fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  									<path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/>
	  									<path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
									</svg>&nbsp;Contraseña  
								</a>
								<hr>
	      						<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="font-size:14px;">
	      							<svg 	width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" 
	      							fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
									</svg>&nbsp;Cerrar
								</a>
				            </div>
				        </li>
		      		@else	
						<a href="{{ route('Registrarse') }}" style="color: white;">
						<center><strong>Registrarse</strong></center></a>
		    		@endif
				</div>   
			@endif
  		</ul>
	</nav>
	@livewireStyles
</head> 
<body> 
  	<div class="d-flex" id="wrapper"> 
  		@if(Auth::guard()->check())
    	<div class="bg-light border-right" id="sidebar-wrapper">
      		<div class="sidebar-heading"><center>MENÚ</center></div>
      		<hr>
  			<div class="list-group list-group-flush">
  				<a href="{{ route('MultaVehicularCiudadano') }}" class="list-group-item list-group-item-action">INGRESAR MULTA</a> 

  		{{-- 		<a href="{{ route('ListaDeMultas') }}" class="list-group-item list-group-item-action">LISTA DE MULTAS</a> --}}

				<div class="dropdown">
		  			<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MULTAS&nbsp;</a>
			  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
			    		<a class="list-group-item list-group-item-action" href="{{ route('ListaDeMultas') }}">MULTAS PENDIENTES</a>
			    		<a class="list-group-item list-group-item-action" href="{{ route('ListaMultasIngresadas') }}">MULTAS INGRESADAS</a>
			  		</div> 
				</div> 
				<div class="dropdown">
		  			<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mantenedores&nbsp;</a>
			  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
			    		<a class="list-group-item list-group-item-action" href="{{ route('EditarCiudadano') }}">Editar Ciudadano</a>
			    		<a class="list-group-item list-group-item-action" 
			    			href="{{ route('AgregarTiposInfra') }}">Agregar Tipos Infracciones</a>
			    		<a class="list-group-item list-group-item-action" href="{{ route('AgregarArticulo') }}">Agregar Infraccione Articulo</a>
			  		</div>
				</div>



				<div class="dropdown">
		  			<a href="" class="list-group-item list-group-item-action dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MULTAS Juzgado&nbsp;</a>
			  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 90%">
			    		<a class="list-group-item list-group-item-action" href="{{ route('JuzListaDeMultas') }}">MULTAS PENDIENTES</a>
			    		<a class="list-group-item list-group-item-action" href="{{ route('JuzMultasIngr') }}">MULTAS INGRESADAS</a>
			  		</div>
				</div>
			</div> 
    	</div>
	    @endif
    	<div id="page-content-wrapper">
		    @yield("content")
		    @livewireScripts
		 	@yield('scripts')
			@yield("foot")
			<footer>
				<br>
			  	<center>
			  		<p>
			  			<a>
			  				<strong>
			  					© {{ date("Y") }} Departamento de informática V 0.1<br>
								Municipalidad de Curicó
							</strong> 
						</a>
					</p>
				</center>
			</footer>
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
      <div class="modal-body">Desea Confirmar</div>
      <div class="modal-footer">
        <button class="btn btn-secondary active" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary active" href="{{ route('CerrarSesion') }}">Aceptar</a>
      </div>
    </div>
  </div>
</div>