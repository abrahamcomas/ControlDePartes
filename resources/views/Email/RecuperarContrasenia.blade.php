@extends('App')
@section('content')
<div class="container-fluid">  
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<br>
			<center><h3><strong>RESTAURACIÓN DE CONTRASEÑA</strong> </h3></center> 
			<hr style="width:100%; border-color: blue;">
			@include('messages')
			<form method="POST" action="{{ route('ContraseniaEnviada') }}">
				@csrf 
               	<div class="form-group">
                  	<div class="form-label-group">
                    	<input type="email" id="Email" name="Email" value="{{ old('Email') }}" class="form-control" placeholder="Ingrese Email" required>
                  	</div>
               	</div>
               	<hr style="width:100%; border-color: blue;"> 
                <center>
                	<button type="submit" class="btn btn-info active" >Aceptar</button>
                </center>
			</form>
			<center>
				<br> 
				<a href="{{ route('Index') }}" style="color: black;"><strong>Volver</strong></a>
			</center>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
	</div>
</div>
@endsection   
