@extends('App')
@section('content')
<div class="container-fluid">   
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<br> 
					<center>
						<h3>Cambiar Email</h3>
					</center>  
					<hr style="width:100%; border-color: blue;">
					<div class="panel-body"> 
						@include('messages')  
						<form method="POST" action="{{ route('FormCorreo') }}">   
							@csrf   
							 <div class="form-group">
		                      	<div class="form-label-group">
		                        	<input type="password" id="passwordActual" name="passwordActual" class="form-control" placeholder="Ingrese Contraseña Actual" >
		                      	</div>
		                   	</div>					                    
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                        	<input type="email" id="Correo" name="Correo" class="form-control" placeholder="Ingrese Nuevo Email" >
		                      	</div>
		                   	</div>
		                   	<hr style="width:100%; border-color: blue;"> 
			                <center>
			                	<button type="submit" class="btn btn-info active" >Aceptar</button>
			                </center>
						</form>
						<center>
							<a href="{{ route('VolverIndex') }}" style="color: black;"><strong>Volver</strong></a>
						</center>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	</div>
</div>
@endsection   

