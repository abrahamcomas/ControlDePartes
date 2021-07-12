@extends('App')
@section('content') 
<div class="container-fluid"> 
	<div class="panel panel-default">
		<div class="panel-heading">
			<br>
			<center><h4><strong>{{ $resultado }}</strong></h4></center> 
			<hr style="width:100%; border-color: blue;">
			<center><a href="{{ route('VolverIndex') }}" style="color: black;"><strong>Volver</strong></a></center> 
		</div>
	</div> 
</div>
@endsection 