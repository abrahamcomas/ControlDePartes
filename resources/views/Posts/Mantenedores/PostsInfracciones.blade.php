@extends('App')
<style type="text/css">
#global {
	height: 200px;
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
}
</style>
@section('content')
	<div class="container-fluid">   
		@livewire('mantenedores.agregar-infracciones')  
	</div>  
@endsection  
@section('scripts')
<script type="text/javascript">
	//Aqui los Script
</script>   
@endsection
