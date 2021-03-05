@extends('App')
@section('content') 
<div class="container-fluid">
	<br>  
	<div class="row">  
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<center><h3><strong>RESTAURAR CONTRASEÑA</strong></h3></center> 
			<hr style="width:100%; border-color: blue;">
			<div class="panel-body"> 
				<center> 
					<h5><strong>Funcionario/a {{ $Datos->Nombres }} {{ $Datos->Apellidos }}</strong></h5>
				</center> 
				<br> 
				@include('messages') 
				<form method="POST" action="{{ route('Restaurar') }}">  
					@csrf @method('PATCH') 
					<input type="hidden" id="id_inspector" name="id_inspector" value="{{ $Datos->id_inspector }}">
	                <div class="form-group">
                      	<div class="form-label-group">
                        	<input type="password" id="Contrasenia" name="Contrasenia" class="form-control" placeholder="Ingrese Contraseña" autocomplete="on">
                      	</div>
	                </div> 
	                <div class="form-group">
                      	<div class="form-label-group"> 
                        	<input type="password" id="Confirmar_Contrasenia" name="Confirmar_Contrasenia" class="form-control" placeholder="Confirmar Contraseña" autocomplete="on">
                      	</div>
	                 </div>
	                <hr style="width:100%; border-color: blue;"> 
	                <center>
	                	<button type="submit" class="btn btn-info active" >Aceptar</button>
	                </center>
				</form>
				<br>
				<center>
					<a href="{{ route('Index') }}" style="color: black;"><strong>Volver</strong></a>
				</center> 
			</div>
		</div> 
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
	</div>
</div> 
@endsection  