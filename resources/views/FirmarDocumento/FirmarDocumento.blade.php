@extends('App')
@section('content') 
<div class="container-fluid">  
	<div class="row"> 
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<br> 
					<form method="POST" action="{{ route('IngresoFirma') }}" accept-charset="UTF-8"  enctype="multipart/form-data">
							@csrf
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label><center>Ingreso OTP</center></label></center> 
		                      		<input type="number" name="OTP" class="form-control" autocomplete="off" placeholder="Codigo OTP">
		                      		<br>
		                        	<input type="file" name="PDF" class="form-control" autocomplete="off">
		                      	</div>
		                   	</div>
		                   	<button type="submit" class="btn btn-success active btn-block">Aceptar</button>
						</form>
					<br>
				</div>
			</div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	</div>
</div>
@endsection  