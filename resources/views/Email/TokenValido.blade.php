@extends('App')
@section('content')  
<br>
<div class="container-fluid">
	<div class="row"> 
      	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			<div class="col"> 
				<div class="card bg-light mb-3">
					<div class="card-header">
					<center><h5><strong>RESTAURAR CONTRASEÑA</strong></h5><br>
					<h5><strong>Funcionario/a {{ $Datos->Nombres }} {{ $Datos->Apellidos }}</strong></h5></center>
					</div>
					<div class="card-body">
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
							<div class="btn-group" style=" width:100%;">	
								<button type="submit" class="btn btn-success active btn-info">Aceptar</button>
							</div>
						</form>
					</div>
					<div class="card-footer text-muted">
						<div class="btn-group" style=" width:100%;">	
							<a href="{{ route('Index') }}" style="color: black;"><strong>Volver</strong></a>
						</div>	      
					</div>
				</div>	
			</div>
      	</div>
      	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    </div>
</div> 
@endsection   