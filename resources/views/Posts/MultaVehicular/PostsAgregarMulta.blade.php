@extends('App')
@section('content')
	<div class="container-fluid">  
		@livewire('multa-vehicular.agregar-multa' , ['Rut' => $Rut])  
	</div>  
@endsection   

