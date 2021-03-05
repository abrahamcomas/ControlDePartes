@extends('App')
@section('content')
<div class="container-fluid">  
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<br>
			@if(Auth::guard()->check())
				<center> 
					<center><h3><strong>SISTEMA CONTROL DE PARTES</strong></h3></center> 
					<hr style="width:100%; border-color: blue;">
						<a href="{{ route('VolverIndex') }}" style="color: black;"><h3>Ingresar</h3></a>
					<hr style="width:100%; border-color: blue;">
				</center>		 
			@endif
			@include('messages')
			<div class="panel panel-default">
				@if(!Auth::guard()->check())
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