@extends('App')
@section('content') 
<div class="row"> 
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
		<div class="col">
			<div class="card bg-light mb-3">
				<div class="card-body">
					<div class="form-group"> 
					<center><h5><strong>{{ $resultado }}</strong></h5></center> 
					</div> 
				</div>
				<div class="card-footer text-muted">
					<center><a href="{{ route('VolverIndex2') }}" style="color: black;"><strong>Volver</strong></a></center> 
				</div>
			</div>  
		</div> 
	</div>		
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>				
</div>	
@endsection 